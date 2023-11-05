<?php

namespace Modules\Order\Repositories;

use Modules\Base\Repositories\BaseRepository;
use Modules\Order\Models\OrderDetail;

class OrderDetailRepository extends BaseRepository
{

	public function __construct()
	{
		$this->model = new OrderDetail();
	}

	public function detailById($id)
	{
		return $this->model->query()->with('order', function ($oq) {
			$oq->with('details');
		})->find($id);
	}
}
