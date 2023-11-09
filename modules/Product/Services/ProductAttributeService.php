<?php

namespace Modules\Product\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Base\Repositories\BaseServiceInterface;
use Modules\Product\Repositories\ProductAttributeRepository;

class ProductAttributeService implements BaseServiceInterface
{

	private $moduleRepository;

	public function __construct(ProductAttributeRepository $moduleRepository)
	{
		$this->moduleRepository = $moduleRepository;
	}

	public function get($data = null)
	{
		return $this->moduleRepository->get($data);
	}


	public function getArray($key = "id")
	{
		return $this->moduleRepository->getArray($key);
	}

	public function list($data)
	{
		return $this->moduleRepository->paginate($data);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function detail($id)
	{
		return $this->moduleRepository->detailById($id);
	}

	/**
	 * @param $id
	 * @param $data
	 *
	 * @return bool|void
	 */
	public function update($id, $data)
	{
		DB::beginTransaction();
		try {
			$attrData = [
				'name'        => $data['name'],
				'key'         => Str::slug($data['name'] . '-' . $data['description']),
				'description' => $data['description'],
				'parent_id'   => null,
			];
			$this->moduleRepository->updateById($id, $attrData);
			$children = [];
			foreach($data['values'] as $value) {
				$description = $value . ' ' . $data['description'];
				$now         = formatDate(Carbon::now(), 'Y-m-d H:i:s');
				$children[]  = [
					'name'        => $value,
					'description' => $description,
					'key'         => Str::slug($data['name']) . '-' . Str::slug($value),
					'parent_id'   => $id,
					'created_at'  => $now,
					'updated_at'  => $now,
				];
			}
			$this->moduleRepository->bulkCreate($children);
			DB::commit();
			session()->flash('success', trans('Updated Successfully.'));
		} catch(Exception $exception) {
			DB::rollBack();
			session()->flash('error', trans('Updated error.'));
		}
	}

	public function create($data)
	{
		DB::beginTransaction();
		try {
			foreach($data['name'] as $item) {
				$attrData = [
					'name'        => $item,
					'key'         => Str::slug($item . '-' . $data['description']),
					'description' => $data['description'],
					'parent_id'   => null,
				];
				$this->moduleRepository->updateOrCreate($attrData, $attrData);
			}
			session()->flash('success', trans('Created successfully.'));
			DB::commit();
		} catch(Exception $exception) {
			session()->flash('error', trans('Created error.'));
			DB::rollBack();
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
			$data = $this->moduleRepository->detailById($id);
			if($data->products->count() > 0) {
				session()->flash('error', trans('Something is using this data.'));
			} else {
				$data->delete();
				session()->flash('success', trans('Deleted successfully.'));
			}
		} catch(Exception $exception) {
			session()->flash('error', trans('Deleted error.'));
		}
	}
}
