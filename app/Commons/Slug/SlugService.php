<?php

namespace App\Commons\Slug;

use App\Commons\CacheData\CacheDataService;
use Modules\Base\Models\Slug;

class SlugService implements SlugInterface
{
	public $slug;

	public $id;

	public $view;

	public $model;

	public $modelName;

	/**
	 * @param $slug
	 *
	 * @return $this
	 */
	public function setSlug($slug)
	{
		$this->slug = $slug;

		return $this;
	}

	/**
	 * @param $id
	 *
	 * @return $this
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	public function init()
	{
		$cacheService = new CacheDataService();

		$query = $cacheService->get('slug_'.$this->slug);
		if (!$query) {
			$query = Slug::query()->where('slug', $this->slug)->first();

			$cacheService->cache('slug_'.$this->slug, $query);
		}
		/*if (!empty($this->id)) {
			$query = $query->where('sluggable_id', $this->id);
		}*/
		if (!empty($query)) {
			$this->modelName = $query->sluggable_type;
			$this->model     = app($query->sluggable_type);
			$this->setView();
		}

		return $this;
	}

	/**
	 * @return void
	 */
	function setView()
	{
		$data       = $this->model->frontendData($this->slug);
		$this->data = $data['data'];
		$this->view = $data['view'];
	}
}