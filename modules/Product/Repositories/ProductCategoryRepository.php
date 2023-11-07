<?php

namespace Modules\Product\Repositories;

use Modules\Base\Repositories\BaseRepository;
use Modules\Product\Models\ProductCategory;

class ProductCategoryRepository extends BaseRepository
{

	public function __construct()
	{
		$this->model = new ProductCategory();
	}

	/**
	 * @param $data
	 *
	 * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
	 */
	public function get($data = NULL)
	{
		$query = $this->model->query();
		if (!empty($data)) {
			$query = $query->where($data);
		}
		return  $query->with(['children', 'products'])->get();
	}

	/**
	 * @return null
	 */
	public function getArray()
	{
		return $this->model->query()
			->tree()
			->select('id', 'name', 'slug', 'parent_id', 'level', 'status')
			->where('status', TRUE)
			->get()
			->toTree()
			->toArray();
	}

	protected function hookFilterResultCustom($query, $filters, $perPage)
	{
		$query = $query->with('parent');
		if (!empty($filters['name'])) {
			$query = $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
		}
		if (!empty($filters['parent'])) {
			$query = $query->where('parent', $filters['parent_id']);
		}

		return $query->paginate($perPage);
	}
}
