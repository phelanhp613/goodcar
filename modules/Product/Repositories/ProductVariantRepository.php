<?php

namespace Modules\Product\Repositories;

use Illuminate\Support\Str;
use Modules\Base\Repositories\BaseRepository;
use Modules\Product\Models\ProductVariant;

class ProductVariantRepository extends BaseRepository
{
	public function __construct()
	{
		$this->model = new ProductVariant();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query()
	{
		return $this->model->query();
	}

	public function detailById($id)
	{
		return $this->model->with('product')->find($id);
	}

	/**
	 * @param $data
	 *
	 * @return false
	 */
	public function create($data)
	{
		$result = $this->model->create($data);
		$result->sluggable()
		       ->create(['slug' => $result->product->slug . "-" . Str::slug($result->name)]);

		return $result;
	}

	/**
	 * @param $id
	 * @param $data
	 * @param $foreign
	 *
	 * @return mixed
	 */
	public function updateById($id, $data, $foreign = false)
	{
		$result = $this->model->find($id);
		$result->update($data);
		$result = $result->refresh();
		$result->sluggable()->updateOrCreate([
			'sluggable_id'   => $result->sluggable->sluggable_id ?? null,
			'sluggable_type' => $result->sluggable->sluggable_type ?? null,
		], ['slug' => Str::slug($result->slug) ?? Str::slug($result->name)]);

		return $result;
	}

	/**
	 * @param array $attribute
	 * @param array $data
	 *
	 * @return mixed
	 */
	public function updateOrCreate(array $attribute = [], array $data = [])
	{
		$result = $this->model->updateOrCreate($attribute, $data);
		$result->sluggable()->updateOrCreate([
			'sluggable_id'   => $result->sluggable->sluggable_id ?? null,
			'sluggable_type' => $result->sluggable->sluggable_type ?? null,
		], ['slug' => Str::slug($result->slug) ?? Str::slug($result->name)]);

		return $result;
	}

	/**
	 * @param $query
	 * @param $filters
	 * @param $perPage
	 *
	 * @return mixed
	 */
	protected function hookFilterResultCustom($query, $filters, $perPage)
	{
		$query = $query->select('id', 'name', 'sku', 'product_id')
		               ->with('product')
		               ->whereHas('product', function($pq) {
						   $pq->where('deleted_at', null);
		               });
		if(!empty($filters['key'])) {
			$query = $query->where('name', 'LIKE', '%' . $filters['key'] . '%');
		}

		return $query->paginate($perPage);
	}
}
