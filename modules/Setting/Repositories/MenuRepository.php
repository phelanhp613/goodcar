<?php

namespace Modules\Setting\Repositories;

use Modules\Base\Repositories\BaseRepository;
use Modules\Setting\Models\Menu;

class MenuRepository extends BaseRepository
{

	public function __construct()
	{
		$this->model = new Menu();
	}

	public function getArray()
	{
		return $this->model->query()->pluck('name', 'id')->toArray();
	}

	protected function hookFilterResultCustom($query, $filters, $perPage)
	{
		return $query->paginate($perPage);
	}
}
