<?php

namespace Modules\Order\Repositories;

use Illuminate\Support\Carbon;
use Modules\Base\Repositories\BaseRepository;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderDetail;

class OrderDetailRepository extends BaseRepository
{

	public function __construct()
	{
		$this->model = new OrderDetail();
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
		$query = $query->with('order');

		$query = $query->whereHas('order', function($q) use ($filters) {
			$q->where('deleted_at', null);
			if (!empty($filters['code'])) {
				$q->where('code', 'LIKE', '%' . $filters['code'] . '%');
			}
			if (!empty($filters['name'])) {
				$q->where('name', 'LIKE', '%' . $filters['name'] . '%');
			}
			if (!empty($filters['phone'])) {
				$q->where('phone', 'LIKE', '%' . $filters['phone'] . '%');
			}
			$q->where('status', Order::STATUS_DELIVERED);
			if (!empty($filters['from_date']) && empty($filters['to_date'])) {
				$from_date = new Carbon($filters['from_date']);
				$from_date = $from_date->format('Y-m-d')." 00:00:00";
				$q->where('created_at', '>', $from_date);
			}
			if (!empty($filters['to_date']) && empty($filters['from_date'])) {
				$to_date = new Carbon($filters['to_date']);
				$to_date = $to_date->format('Y-m-d')." 23:59:59";
				$q->where('created_at', '<', $to_date);
			}
			if (!empty($filters['to_date']) && !empty($filters['from_date'])) {
				$from_date = new Carbon($filters['from_date']);
				$to_date = new Carbon($filters['to_date']);
				if (strtotime($from_date) < strtotime($to_date)) {
					$from_date = $from_date->format('Y-m-d')." 00:00:00";
					$to_date = $to_date->format('Y-m-d')." 23:59:59";
					$q->whereBetween('created_at', [$from_date, $to_date]);
				} else {
					$from_date = $from_date->format('Y-m-d')." 23:59:59";
					$to_date = $to_date->format('Y-m-d')." 00:00:00";
					$q->whereBetween('created_at', [$to_date, $from_date]);
				}
			}
		});

		if(!empty($filters['chassis_number'])) {
			$query = $query->where('chassis_number', 'LIKE', '%' . $filters['chassis_number'] . '%');
		}
		if(!empty($filters['vehicle_engine_number'])) {
			$query = $query->where('vehicle_engine_number', 'LIKE', '%' . $filters['vehicle_engine_number'] . '%');
		}

		return $query->paginate($perPage);
	}

	public function detailById($id)
	{
		return $this->model->query()->with('order', function ($oq) {
			$oq->with('details');
		})->find($id);
	}
}
