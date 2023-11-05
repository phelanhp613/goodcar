<?php

namespace Modules\Product\Repositories;

use Illuminate\Support\Str;
use Modules\Base\Repositories\BaseRepository;
use Modules\Product\Models\ProductAttribute;

class ProductAttributeRepository extends BaseRepository
{
	public function __construct()
	{
		$this->model = new ProductAttribute();
	}

	public function getArray($key = "id")
	{
		return $this->model->query()
		                   ->where('parent_id', NULL)
		                   ->orderBy('name')
		                   ->pluck("name", $key)
		                   ->toArray();
	}

	/**
	 * @param $data
	 *
	 * @return array
	 */
	public function getIds($data)
	{
		$ids = [];
		if (!empty($data)) {
			foreach ($data as $item) {
				$tag   = $this->model->query()->firstOrCreate([
					'name' => Str::ucfirst($item),
					'key'  => Str::slug(ucfirst($item)),
				]);
				$ids[] = $tag->id;
			}
		}

		return $ids;
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
	 */
	public function detailById($id)
	{
		return $this->model->with('children')->find($id);
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
		$query = $query->with('children')->where('parent_id', NULL);
		if (!empty($filters['name'])) {
			$query = $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
		}

		return $query->paginate($perPage);
	}


	/**
	 * @param $id
	 * @param $data
	 * @param $foreign
	 *
	 * @return mixed
	 */
	public function updateById($id, $data, $foreign = FALSE)
	{
		$result = $this->model->find($id);
		$result->children->each->delete();
		$result->update($data);

		return $result->refresh();
	}

}
