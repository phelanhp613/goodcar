<?php

namespace Modules\Order\Repositories;

use Illuminate\Support\Carbon;
use Modules\Base\Repositories\BaseRepository;
use Modules\Order\Models\Order;

class OrderRepository extends BaseRepository
{

	public function __construct()
	{
		$this->model = new Order();
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
	 */
	public function detailById($id) {
		return $this->model->query()->with('details', function ($dq) {
			$dq->with('productVariant', function($pvq) {
				$pvq->with('product');
				$pvq->with('attributePivots', function($apq) {
					$apq->with('attribute');
				});
			});
		})->find($id);
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
		$query = $query->with(['details']);
		if (!empty($filters['code'])) {
			$query = $query->where('code', 'LIKE', '%' . $filters['code'] . '%');
		}
		if (!empty($filters['name'])) {
			$query = $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
		}
		if (!empty($filters['phone'])) {
			$query = $query->where('phone', 'LIKE', '%' . $filters['phone'] . '%');
		}
		if (isset($filters['status'])) {
			$query = $query->where('status', $filters['status']);
		}
		if (!empty($filters['from_date']) && empty($filters['to_date'])) {
			$from_date = new Carbon($filters['from_date']);
			$from_date = $from_date->format('Y-m-d')." 00:00:00";
			$query = $query->where('created_at', '>', $from_date);
		}
		if (!empty($filters['to_date']) && empty($filters['from_date'])) {
			$to_date = new Carbon($filters['to_date']);
			$to_date = $to_date->format('Y-m-d')." 23:59:59";
			$query = $query->where('created_at', '<', $to_date);
		}
		if (!empty($filters['to_date']) && !empty($filters['from_date'])) {
			$from_date = new Carbon($filters['from_date']);
			$to_date = new Carbon($filters['to_date']);
			if (strtotime($from_date) < strtotime($to_date)) {
				$from_date = $from_date->format('Y-m-d')." 00:00:00";
				$to_date = $to_date->format('Y-m-d')." 23:59:59";
				$query = $query->whereBetween('created_at', [$from_date, $to_date]);
			} else {
				$from_date = $from_date->format('Y-m-d')." 23:59:59";
				$to_date = $to_date->format('Y-m-d')." 00:00:00";
				$query = $query->whereBetween('created_at', [$to_date, $from_date]);
			}
		}

		return $query->paginate($perPage);
	}
}
