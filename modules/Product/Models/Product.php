<?php

namespace Modules\Product\Models;

use App\Commons\CacheData\CacheDataService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use Modules\Base\Models\BaseModel;
use Modules\Base\Models\Slug;
use Modules\Base\Models\Status;
use Modules\Tag\Models\Tag;
use Modules\User\Models\User;

class Product extends BaseModel
{

	public $timestamps = true;

	protected $table = "products";

	protected $primaryKey = "id";

	protected $guarded = [];

	protected static function boot()
	{
		parent::boot();

		static::deleting(function($data) {
			$data->variants->each->delete();
			if(!empty($data->sluggable)) {
				$data->sluggable->delete();
			}
		});
	}

	/**
	 * @return MorphOne
	 */
	public function sluggable()
	{
		return $this->morphOne(Slug::class, 'sluggable');
	}

	/**
	 * @return MorphToMany
	 */
	public function tags()
	{
		return $this->morphToMany(Tag::class, 'taggable');
	}

	/**
	 * @return BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(ProductCategory::class, 'product_category_id');
	}

	/**
	 * @return hasMany
	 */
	public function variants()
	{
		return $this->hasMany(ProductVariant::class, 'product_id');
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
	 * @param $slug
	 *
	 * @return array
	 */
	public function frontendData($slug)
	{
		$cacheService = new CacheDataService();
		$data         = $cacheService->get('product_' . $slug);
		if(!$data) {
			$data = self::query()
			            ->with('variants', function($vq) {
				            $vq->with('attributePivots');
			            })
			            ->with('category', function($cq) {
				            $cq->with('products', function($vq) {
					            $vq->with('variants');
				            });
			            })
			            ->where('slug', $slug)
			            ->where('status', Status::STATUS_ACTIVE)
			            ->first()
			            ->withShortCode();

			$cacheService->cache('product_' . $slug, $data);
		}
		$view = 'Frontend::product.product_detail';

		return compact('data', 'view');
	}

	/**
	 * @param $data
	 *
	 * @return array
	 */
	public function getData($data)
	{
		$product      = $data->data;
		$cacheService = new CacheDataService();

		/** Get product attributes */
		$productAttributes = $cacheService->get('product_attributes_' . $product->id);
		if(!$productAttributes) {
			$attrs               = json_decode($product->attribute_ids, 1);
			$attribute_ids       = array_keys($attrs);
			$productAttributesDB = ProductAttribute::query()
			                                       ->with('children')
			                                       ->whereIn('id', $attribute_ids)
			                                       ->get();

			$productAttributes = [];
			foreach($productAttributesDB as $productAttribute) {
				$children = [];
				foreach($productAttribute->children as $child) {
					$valueKey = $attrs[$productAttribute->id] ?? [];
					if(in_array($child->key, $valueKey)) {
						$children[] = $child;
					}
				}
				$productAttribute->selectedChildren = $children;
				$productAttributes[]                = $productAttribute;
			}

			$cacheService->cache('product_attributes_' . $product->id, $productAttributes);
		}

		/** Get variant selected */
		$attr = request()->attr ?? [];
		if(!empty($attr)) {
			$variantSelected = $this->getProductVariantSelected($product, $attr);
		} else {
			$variantSelected = $product->rootVariant();
		}

		/** Get related products */
		$related_products = $product->category->products
			                    ->where('id', '<>', $product->id)
			                    ->where('status', 1)
			                    ->take(20) ?? [];

		return [
			'data'               => $data->data,
			'related_products'   => $related_products ?? [],
			'product_attributes' => $productAttributes ?? [],
			'variant_selected'   => $variantSelected ?? [],
		];
	}

	/**
	 * @param $product
	 * @param $attr
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
	 */
	function getProductVariantSelected($product, $attr)
	{
		$cacheService          = new CacheDataService();
		$keyCacheAttrNames     = 'product_attribute_variant_selected_names_' . implode('_', $attr);
		$productAttributeNames = $cacheService->get($keyCacheAttrNames);
		if(!$productAttributeNames) {
			$productAttributeNames = ProductAttribute::query()
			                                         ->whereIn('key', $attr)
			                                         ->orderBy('name')
			                                         ->pluck('name')
			                                         ->toArray();
			$cacheService->cache($keyCacheAttrNames, $productAttributeNames);
		}
		$productAttributeNameKey = Str::slug(implode('-', $productAttributeNames));
		$variants                = [];
		foreach($product->variants as $variant) {
			$variantAttr               = $variant->attributePivots->sortBy('value')
			                                                      ->pluck('value')
			                                                      ->toArray();
			$variantAttrKey            = Str::slug(implode('-', $variantAttr));
			$variants[$variantAttrKey] = $variant;
		}

		return $variants[$productAttributeNameKey] ?? null;
	}

	/**
	 * @return mixed
	 */
	public function rootVariant()
	{
		return $this->variants->first();
	}
}
