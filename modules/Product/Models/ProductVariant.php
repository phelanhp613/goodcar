<?php

namespace Modules\Product\Models;

use App\Commons\CacheData\CacheDataService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Base\Models\BaseModel;
use Modules\Base\Models\Slug;
use Modules\Base\Models\Status;
use Modules\Comment\Repositories\CommentRepository;
use Modules\Comment\Repositories\CommentService;
use Modules\User\Models\User;

class ProductVariant extends BaseModel
{

	public $timestamps = true;

	protected $table = "product_variants";

	protected $primaryKey = "id";

	protected $guarded = [];

	protected static function boot()
	{
		parent::boot();

		static::deleting(function($data) {
			$data->attributes()->detach();
			$data->sluggable->delete();
		});
	}

	/**
	 * @return BelongsToMany
	 */
	public function attributes()
	{
		return $this->belongsToMany(ProductAttribute::class, 'product_values', 'product_id',
			'attribute_id')
		            ->withPivot('attribute_id', 'product_id', 'value')->with('children');
	}

	/**
	 * @return MorphOne
	 */
	public function sluggable()
	{
		return $this->morphOne(Slug::class, 'sluggable');
	}

	/**
	 * @return BelongsTo
	 */
	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}

	/**
	 * @return BelongsTo
	 */
	public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	/**
	 * @return BelongsTo
	 */
	public function updatedBy()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function attributePivots()
	{
		return $this->hasMany(ProductValue::class, 'product_id');
	}

	/**
	 * @param $slug
	 *
	 * @return array
	 */
	public function frontendData($slug)
	{
		$cacheService = new CacheDataService();
		$variant      = $cacheService->get('product_variant_' . $slug);
		if(!$variant) {
			$variant = self::query()
			               ->with('attributePivots')
			               ->with('product', function($pq) {
				               $pq->with('variants', function($vq) {
					               $vq->with('attributePivots');
				               })->with('category', function($cq) {
					               $cq->with('products');
				               });
			               })
			               ->where('slug', $slug)
			               ->first();

			$cacheService->cache('product_variant_' . $slug, $variant);
		}
		$data = $variant->product;
		$view = 'Frontend::product.product_detail';

		return compact('data', 'view');
	}

	public function getData($data)
	{
		$product      = $data->data;
		$cacheService = new CacheDataService();

		/** Get product attributes */
		$productAttributes = $cacheService->get('product_attributes_' . $product->id);
		if(!$productAttributes) {
			$productAttributes = ProductAttribute::query()
			                                     ->with('children')
			                                     ->whereIn('id',
				                                     json_decode($product->attribute_ids, 1))
			                                     ->get();

			$cacheService->cache('product_attributes_' . $product->id, $productAttributes);
		}
		$variantSelected                   = $product->variants->where('slug', $data->slug)
		                                                       ->first();
		$variantSelected->suggest_products = ProductVariant::query()
		                                                   ->with('product', function($pq) {
			                                                   $pq->with('variants');
		                                                   })
		                                                   ->whereHas('product', function($pq) {
			                                                   $pq->where('deleted_at', null);
		                                                   })
		                                                   ->whereIn('id',
			                                                   json_decode($variantSelected->suggest_product_ids,
				                                                   1))
		                                                   ->get();

		/** Get related products */
		$related_products = $product->category
			                    ->products
			                    ->where('id', '<>', $product->id)
			                    ->where('status', Status::STATUS_ACTIVE)
			                    ->take(20) ?? [];

		/** Get comments */
		$commentService = new CommentService(new CommentRepository());
		$comments       = $commentService->listFrontend([
			//			'status' => 1,
			'product_id' => $product->id,
		]);

		return [
			'data'               => $data->data,
			'related_products'   => $related_products ?? [],
			'product_attributes' => $productAttributes ?? [],
			'variant_selected'   => $variantSelected ?? [],
			'comments'           => $comments ?? [],
		];
	}
}
