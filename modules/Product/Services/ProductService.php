<?php

namespace Modules\Product\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Base\Components\TextareaContentTab;
use Modules\Base\Repositories\BaseServiceInterface;
use Modules\Product\Models\FlashSaleConfig;
use Modules\Product\Repositories\ProductAttributeRepository;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Repositories\ProductVariantRepository;
use Modules\Tag\Repositories\TagRepository;

class ProductService implements BaseServiceInterface
{

	private $moduleRepository;

	private $productVariantRepository;

	private $tagRepository;

	private $productAttributeRepository;

	private $attributeVariants;

	public function __construct(
		ProductRepository $moduleRepository,
		ProductVariantRepository $productVariantRepository,
		ProductAttributeRepository $productAttributeRepository,
		TagRepository $tagRepository,
	) {
		$this->tagRepository              = $tagRepository;
		$this->moduleRepository           = $moduleRepository;
		$this->productVariantRepository   = $productVariantRepository;
		$this->productAttributeRepository = $productAttributeRepository;
	}

	public function list($data)
	{
		if(!empty($data['column_asc'])) {
			return $this->moduleRepository->paginate($data, 20, $data['column_asc'], 'ASC');
		} elseif(!empty($data['column_desc'])) {
			return $this->moduleRepository->paginate($data, 20, $data['column_desc']);
		}

		return $this->moduleRepository->paginate($data);
	}

	public function detail($id)
	{
		return $this->moduleRepository->detailById($id);
	}

	/**
	 * @param $id
	 * @param $request
	 *
	 */
	public function updateAttributeHasVariant($id, $data)
	{
		$attrs = $data['attrs'] ?? [];
		DB::beginTransaction();
		try {
			$attribute_ids = array_keys($attrs);
			$data          = $this->moduleRepository->updateById($id,
				['attribute_ids' => json_encode($attrs)], true);
			$data->variants->each->delete();
			if(!empty($attribute_ids)) {
				$attributes = $this->productAttributeRepository->findBy()
				                                               ->with('children')
				                                               ->whereIn('id', $attribute_ids)
				                                               ->get()
				                                               ->toArray();
				$children   = [];
				foreach($attributes as $key => $attribute) {
					foreach($attribute['children'] as $child) {
						$valueID = array_keys($attrs[$attribute['id']] ?? []);
						if(in_array($child['id'], $valueID)) {
							$children[$key][] = $child;
						}
					}
				}
				$attributeGroups = $this->generateAttributeVariants($children);

				foreach($attributeGroups as $group) {
					$names   = implode(" ", array_column($group, 'value'));
					$variant = $this->createVariant($data,
						['name' => $data->name . ' - ' . $names, 'slug' => Str::slug($data->name . ' - ' . $names), 'is_root' => false]);
					$variant->attributes()->sync($group);
				}
			}
			DB::commit();
		} catch(Exception $exception) {
			DB::rollBack();
			session()->flash('error', trans('Something went wrong'));
		}
	}

	/**
	 * @param $id
	 *
	 * @return void
	 */
	public function delete($id)
	{
		try {
			$this->moduleRepository->deleteById($id);
			session()->flash('success', trans('Deleted successfully.'));
		} catch(Exception $exception) {
			session()->flash('error', trans('Deleted error.'));
		}
	}

	public function findBy($data = [])
	{
		return $this->moduleRepository->findBy($data);
	}

	/**
	 * @param $data
	 * @param int $index
	 * @param array $ids
	 *
	 * @return mixed
	 */
	public function generateAttributeVariants($data, int $index = 0, array $ids = [])
	{
		if($index < count($data)) {
			foreach($data[$index] as $item) {
				if($index == count($data) - 1) {
					$this->attributeVariants[] = array_merge($ids,
						[["attribute_id" => $item['parent_id'], "attribute_key" => $item['key'], "value" => $item['name']]]);
				} else {
					$newIds = array_merge($ids,
						[["attribute_id" => $item['parent_id'], "attribute_key" => $item['key'], "value" => $item['name']]]);
					$this->generateAttributeVariants($data, $index + 1, $newIds);
				}
			}
		}

		return $this->attributeVariants;
	}

	/**
	 * @param $product
	 * @param array $variantData
	 *
	 * @return false
	 */
	private function createVariant($product, array $variantData = [])
	{
		return $this->productVariantRepository->create([
			"name"                => !empty($variantData["name"]) ? $variantData["name"] : $product->name,
			"slug"                => !empty($variantData["slug"]) ? $variantData["slug"] : $product->slug,
			"sku"                 => $product->sku,
			"images"              => $product->images,
			"stock"               => !empty($variantData["stock"]) ? $variantData['stock'] : 0,
			"price"               => !empty($variantData["price"]) ? $variantData['price'] : 0,
			"discount"            => !empty($variantData["discount"]) ? $variantData['discount'] : 0,
			"product_id"          => $product->id,
			"is_root"             => $variantData['is_root'] ?? true,
			"created_by"          => $product->created_by,
			"updated_by"          => $product->created_by,
			"suggest_product_ids" => $variantData['suggest_product_ids'] ?? '[]',
		]);
	}

	/**
	 * @param $data
	 *
	 * @return array|false
	 */
	public function create($data)
	{
		$product = [];
		DB::beginTransaction();
		try {
			$variantData                        = !empty($data['variants']) ? $data['variants'] : null;
			$variantData['suggest_product_ids'] = json_encode($variantData['suggest_product_ids'] ?? []);
			$tag_ids                            = $this->tagRepository->getIds($data['tags'] ?? []);
			$data['featured']                   = !empty($data['featured']) ? 1 : 0;
			$data['attribute_ids']              = json_encode($data['attribute_ids'] ?? []);
			$data['images']                     = json_encode($data['images'] ?? []);
			$data['product_category_ids']       = json_encode($data['product_category_ids'] ?? []);
			$data['created_by']                 = auth('admin')->id();
			$data['updated_by']                 = auth('admin')->id();
			$data['content']                    = json_encode(TextareaContentTab::setContent($data['content'] ?? []));
			$data['content']                    = replaceOldUrl($data['content']);
			unset($data['tags'], $data['variants'], $data['attributes']);
			$product = $this->moduleRepository->create($data);
			if(!empty($product)) {
				$product->tags()->sync($tag_ids);
				if(!$product->has_variant) {
					$this->createVariant($product, $variantData);
				}
			}
			session()->flash('success', trans('Created successfully.'));
			DB::commit();
		} catch(Exception $exception) {
			session()->flash('error', trans('Created error.'));
			DB::rollBack();
		}

		return $product;
	}

	/**
	 * @return void
	 */
	public function updateImages($id, $data)
	{
		$data['images'] = json_encode($data['images']);
		$data['images'] = replaceOldUrl($data['images']);
		$this->moduleRepository->detailById($id)->update($data);
	}

	public function update($id, $data)
	{
		DB::beginTransaction();
		try {
			$data['featured'] = !empty($data['featured']) ? 1 : 0;
			$variantData      = $data['variants'] ?? [];
			$tag_ids          = $this->tagRepository->getIds($data['tags'] ?? []);
			$attribute_values = $data['attribute_values'] ?? [];
			if(isset($data['attribute_ids'])) {
				$data['attribute_ids'] = json_encode($data['attribute_ids']);
			}
			$data['has_variant'] = (int) ($data['has_variant'] ?? 1);
			$mainImage           = $data['images']['main'] ?? '';
			$data['updated_by']  = auth('admin')->id();
			unset(
				$data['tags'],
				$data['attributes'],
				$data['attribute_values'],
				$data['next-step'],
				$data['variants'],
				$data['images']
			);
			$data['content'] = json_encode(TextareaContentTab::setContent($data['content'] ?? []));
			$data['content'] = replaceOldUrl($data['content']);
			$product         = $this->moduleRepository->updateById($id, $data);
			$images          = json_decode($product->images);
			$images->main    = $mainImage;
			$product->update(['images' => json_encode($images)]);
			if(!$product->has_variants) {
				$variantData['suggest_product_ids'] = json_encode($variantData['suggest_product_ids'] ?? []);
			}
			$product->tags()->sync($tag_ids);
			$this->updateAttribute($product, $attribute_values, $variantData);
			session()->flash('success', trans('Updated successfully.'));
			DB::commit();
		} catch(Exception $exception) {
			session()->flash('error', trans('Updated error.'));
			DB::rollBack();
		}
	}

	/**
	 * @param $product
	 * @param $attribute_values
	 * @param array $variantData
	 *
	 * @return void
	 */
	public function updateAttribute($product, $attribute_values, array $variantData = [])
	{
		if(!$product->has_variant) {
			$rootVariant = $product->rootVariant();
			if(empty($rootVariant)) {
				$rootVariant = $this->createVariant($product, $variantData);
			}
			if(!empty($variantData)) {
				$rootVariant->update($variantData);
			}
			$rootVariant->attributes()->sync($attribute_values);
		}
	}

	/**
	 * @param $id
	 * @param $data
	 *
	 * @return void
	 */
	public function postUpdateProductFeatured($id, $data)
	{
		DB::beginTransaction();
		try {
			$params['featured'] = !empty($data['featured']) ? 1 : 0;
			$data               = $this->moduleRepository->detailById($id);
			$data->update($params);
			session()->flash('success', trans('Updated successfully.'));
			DB::commit();
		} catch(Exception $exception) {
			session()->flash('error', trans('Updated error.'));
			DB::rollBack();
		}
	}

	/**
	 * @param array $data
	 *
	 * @return void
	 */
	public function flashSaleConfig(array $data)
	{
		DB::beginTransaction();
		try {
			unset($data['_token']);
			foreach($data as $key => $value) {
				$input  = [
					'key'   => $key,
					'value' => is_array($value) ? json_encode($value) : $value,
				];
				$config = FlashSaleConfig::query()->where('key', $key)->first();
				if(!empty($config)) {
					$config->update($input);
				} else {
					$config = new FlashSaleConfig($input);
					$config->save();
				}
			}
			if(empty($data['FLASH_SALE_FOR_60_PERCENT'])) {
				$key    = 'FLASH_SALE_FOR_60_PERCENT';
				$input  = [
					'key'   => $key,
					'value' => 0,
				];
				$config = FlashSaleConfig::query()->where('key', $key)->first();
				if(!empty($config)) {
					$config->update($input);
				} else {
					$config = new FlashSaleConfig($input);
					$config->save();
				}
			}
			if(empty($data['FLASH_SALE_ADD_MORE_PRODUCTS'])) {
				$key    = 'FLASH_SALE_ADD_MORE_PRODUCTS';
				$input  = [
					'key'   => $key,
					'value' => json_encode([]),
				];
				$config = FlashSaleConfig::query()->where('key', $key)->first();
				if(!empty($config)) {
					$config->update($input);
				} else {
					$config = new FlashSaleConfig($input);
					$config->save();
				}
			}
			DB::commit();
			session()->flash('success', trans('Updated successfully.'));
		} catch(Exception $exception) {
			DB::rollBack();
			session()->flash('error', trans('Updated error.'));
		}
	}

	/**
	 * @param $product
	 * @param $variants
	 * @param $attribute_ids
	 * @param $attribute_values
	 *
	 * @return void
	 */
	private function handleVariantData($product, $variants, $attribute_ids, $attribute_values)
	{
		$variants = $product->has_variant ? $variants : [$variants];
		foreach($variants as $variant) {
			if(!empty($variant)) {
				$variant['name']       = !empty($variant['name']) ? $variant['name'] : $product->name . '-' . Str::uuid();
				$variant['product_id'] = $product->id;
				$variant['created_by'] = $product->created_by;
				$variant['updated_by'] = auth('admin')->id();
				$data                  = $this->productVariantRepository->updateOrCreate([
					"product_id" => $product->id,
					"sku"        => $variant['sku'],
					"created_by" => $product->created_by,
				], $variant);
				$data->attributes()->sync($attribute_ids);
				if(!empty($attribute_values)) {
					foreach($attribute_values as $id => $value) {
						$data->attributes()->updateExistingPivot($id, $value);
					}
				}
			}
		}
	}
}
