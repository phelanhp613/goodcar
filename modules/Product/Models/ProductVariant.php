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
		if (!$productAttributes) {
			$attrs               = json_decode($product->attribute_ids, 1);
			$attribute_ids       = array_keys($attrs);
			$productAttributesDB = ProductAttribute::query()
			                                       ->with('children')
			                                       ->whereIn('id', $attribute_ids)
			                                       ->get();

			$productAttributes = [];
			foreach ($productAttributesDB as $productAttribute) {
				$children = [];
				foreach ($productAttribute->children as $child) {
					$valueKey = $attrs[$productAttribute->id] ?? [];
					if (in_array($child->key, $valueKey)) {
						$children[] = $child;
					}
				}
				$productAttribute->selectedChildren = $children;
				$productAttributes[]                = $productAttribute;
			}

			$cacheService->cache('product_attributes_' . $product->id, $productAttributes);
		}
		$variantSelected = $product->variants->where('slug', $data->slug)->first();

		/** Get comments */

		return [
			'data'               => $data->data,
			'product_attributes' => $productAttributes ?? [],
			'variant_selected'   => $variantSelected,
		];
	}
}
