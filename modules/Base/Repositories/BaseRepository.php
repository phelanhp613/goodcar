<?php

namespace Modules\Base\Repositories;

use Illuminate\Support\Str;

class BaseRepository
{

	protected $model;

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function get($data)
	{
		return $this->model->where($data)->get();
	}

	/**
	 * @param $data
	 *
	 * @return false
	 */
	public function create($data)
	{
		if (method_exists($this->model, 'sluggable')) {
			$data['slug'] = Str::slug(!empty($data['slug']) ? $data['slug'] : ($data['name'] ?? $data['title']));
		}
		$result = $this->model->create($data);
		if (method_exists($result, 'sluggable')) {
			$result->sluggable()->updateOrCreate([
				'sluggable_id'   => $result->sluggable->sluggable_id ?? $result->id ?? NULL,
				'sluggable_type' => $result->sluggable->sluggable_type ?? get_class($this->model) ?? NULL,
			], [
				'slug' => $data['slug']
			]);
		}

		return $result;
	}

	/**
	 * @param $data
	 *
	 * @return false
	 */
	public function bulkCreate($data)
	{
		return $this->model->insert($data);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function detailById($id)
	{
		return $this->model->find($id);
	}

	/**
	 * @param array $data
	 *
	 * @return mixed
	 */
	public function findBy(array $data = [])
	{
		if (!empty($data)) {
			return $this->model->where($data);
		}

		return $this->model;
	}

	/**
	 * @param $id
	 * @param $data
	 *
	 * @return mixed
	 */
	public function updateById($id, $data, $foreign = FALSE)
	{
		$result = $this->model->find($id);
		if (method_exists($result, 'sluggable') && !$foreign) {
			$data['slug'] = Str::slug(!empty($data['slug']) ? $data['slug'] : ($data['name'] ?? $data['title']));
			$result->sluggable()->updateOrCreate([
				'sluggable_id'   => $result->sluggable->sluggable_id ?? $result->id ?? NULL,
				'sluggable_type' => $result->sluggable->sluggable_type ?? get_class($this->model) ?? NULL,
			], [
				'slug' => $data['slug']
			]);
		}
		$result->update($data);

		return $result->refresh();
	}

	/**
	 * @param array $attribute
	 * @param array $data
	 *
	 * @return mixed
	 */
	public function updateOrCreate(array $attribute = [], array $data = [])
	{
		if (method_exists($this->model, 'sluggable')) {
			$data['slug'] = Str::slug(!empty($data['slug']) ? $data['slug'] : ($data['name'] ?? $data['title']));
		}
		$result = $this->model->updateOrCreate($attribute, $data);
		if (method_exists($result, 'sluggable')) {
			$result->sluggable()->updateOrCreate([
				'sluggable_id'   => $result->sluggable->sluggable_id ?? $result->id ?? NULL,
				'sluggable_type' => $result->sluggable->sluggable_type ?? get_class($this->model) ?? NULL,
			], ['slug' => $data['slug']]);
		}

		return $result;
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function deleteById($id)
	{
		$result = $this->model->find($id);
		if (method_exists($result, 'sluggable')) {
			if (!empty($result->sluggable)) {
				$result->sluggable->delete();
			}
		}

		return $result->delete();
	}

	/**
	 * @param $params
	 * @param $perPage
	 * @param $orderBy
	 * @param $direction
	 *
	 * @return mixed
	 */
	public function paginate($params, $perPage = 20, $orderBy = 'created_at', $direction = 'DESC')
	{
		$query = $this->model->query()->orderBy($orderBy, $direction);

		return $this->hookFilterResultCustom($query, $params, $perPage);
	}

	protected function hookFilterResultCustom($query, $params, $perPage)
	{
		if (!empty($params)) {
			$query = $query->where($params);
		}

		return $query->paginate($perPage);
	}
}
