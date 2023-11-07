<?php

namespace Modules\Product\Models;

use App\Commons\CacheData\CacheDataService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\DB;
use Modules\Base\Models\BaseModel;
use Modules\Base\Models\Slug;
use Modules\Base\Models\Status;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class ProductCategory extends BaseModel
{
	use HasRecursiveRelationships;

	public $timestamps = true;

	protected $table = "product_categories";

	protected $primaryKey = "id";

	protected $guarded = [];

	/**
	 * @return BelongsTo
	 */
	public function parent()
	{
		return $this->belongsTo(self::class, 'parent_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function childrenRecursive()
	{
		return $this->children()->with('childrenRecursive');
	}

	/**
	 * @return HasMany
	 */
	public function children()
	{
		return $this->hasMany(self::class, 'parent_id');
	}

	/**
	 * @return MorphOne
	 */
	public function sluggable()
	{
		return $this->morphOne(Slug::class, 'sluggable');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function products()
	{
		return $this->hasMany(Product::class, 'product_category_id');
	}

	/**
	 * @param $slug
	 *
	 * @return array
	 */
	public function frontendData($slug)
	{
		$cacheService = new CacheDataService();
		$data         = $cacheService->get('product_category_' . $slug);
		if(!$data) {
			$data = self::query()
			            ->with('children', function($cq) {
				            $cq->where('status', Status::STATUS_ACTIVE);
			            })
			            ->where('slug', $slug)
			            ->first();

			$cacheService->cache('product_category_' . $slug, $data);
		}

		$view = (!empty($data) && !$data->children->isEmpty()) ? 'Frontend::product.category_page' : 'Frontend::product.product_listing';

		return compact('data', 'view');
	}


	/**
	 * @param $dataSlug
	 *
	 * @return array
	 */
	public function getData($dataSlug)
	{

		$category = $dataSlug->data;
		$products = Product::query()
		                   ->with('variants', 'category')
		                   ->where('status', Status::STATUS_ACTIVE);
		if($category->children->count() > 0) {
			$request = request()->all();
			if(!empty($request['sort_by'])) {
				if($request['sort_by'] !== 'best_sellers') {
					$products = $products->join('product_variants', function($join) {
						$join->on('product_variants.product_id', '=', 'products.id');
					});
					$products = $products->select(
						'products.id',
						'products.name',
						'products.slug',
						'products.sku',
						'products.images',
						'products.product_category_id',
						'products.product_category_ids',
						DB::raw("COALESCE(NULLIF(MIN(product_variants.discount), 0), NULLIF(MIN(product_variants.price), 0)) as final_price"),
					)->groupBy([
						'product_variants.product_id',
						'products.id',
						'products.name', 'products.slug',
						'products.sku',
						'products.images',
						'products.product_category_id',
						'products.product_category_ids',
					]);
					if($request['sort_by'] === "price_up") {
						$products = $products->orderBy('final_price');
					} else {
						$products = $products->orderBy('final_price', 'desc');
					}
				}
			} else {
				$products = $products->select(
					'id',
					'name',
					'slug',
					'sku',
					'images',
					'product_category_id',
					'product_category_ids');
			}

			$minPrice = $request['min_price'] ?? 0;
			$maxPrice = $request['max_price'] ?? 100000000;
			$products = $products->whereHas('variants', function($vq) use ($minPrice, $maxPrice) {
				$vq->whereBetween('price', [(int) $minPrice, (int) $maxPrice]);
			});

			if(!empty($request['categories'])) {
				$category_ids = ProductCategory::query()
				                               ->whereIn('slug', $request['categories'])
				                               ->pluck('id');
				$category_ids = [...$category_ids, ...ProductCategory::query()
				                                                     ->whereIn('parent_id',
					                                                     $category_ids)
				                                                     ->pluck('id')];
			} else {
				$category_ids = ProductCategory::query()
				                               ->where('parent_id', $category->id)
				                               ->get('id');
				$category_ids = [...$category_ids, ...[$category->id]];
			}

			$products = $products->where(function($q) use ($category_ids) {
				$q = $q->orWhereIn('product_category_id', $category_ids);
				foreach($category_ids as $category_id) {
					$q = $q->orWhereJsonContains('product_category_ids', (string) $category_id);
				}
			});

			$products = $products->where('status', Status::STATUS_ACTIVE)
			                     ->orderBy('featured', 'desc')
			                     ->orderBy('created_at', 'desc')
			                     ->paginate(21);
		} else {
			$products = $products->where('product_category_id', $category->id);
			$products = $products->orWhereJsonContains('product_category_ids',
				(string) $category->id);

			$products = $products->where('status', Status::STATUS_ACTIVE)
			                     ->orderBy('featured', 'desc')
			                     ->orderBy('created_at', 'desc')
			                     ->paginate(20);
		}

		return [
			'data'     => $category,
			'products' => $products ?? [],
		];
	}
}
