<?php

namespace Modules\Product\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Base\Repositories\BaseServiceInterface;
use Modules\Product\Repositories\ProductVariantRepository;

class ProductVariantService implements BaseServiceInterface
{
	private $moduleRepository;

	public function __construct(
		ProductVariantRepository $moduleRepository,
	) {
		$this->moduleRepository = $moduleRepository;
	}

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function list($data)
	{
		return $this->moduleRepository->paginate($data);
	}

	public function create($data)
	{
		// TODO: Implement create() method.
	}

	public function detail($id)
	{
		return $this->moduleRepository->detailById($id);
	}

	public function update($id, $data)
	{
		DB::beginTransaction();
		try {
			$data['price']               = !empty($data['price']) ? $data['price'] : 0;
			$data['discount']            = !empty($data['discount']) ? $data['discount'] : 0;
			$data['stock']               = !empty($data['stock']) ? $data['stock'] : 0;
			$data['suggest_product_ids'] = json_encode($data['suggest_product_ids'] ?? []);
			if(!empty($data['quick_update'])) {
				unset($data['suggest_product_ids'], $data['quick_update']);
			}
			if(empty($data['name'])) {
				$variant      = $this->moduleRepository->detailById($id);
				$data['name'] = $variant->product->name;
				$variant->update($data);
			} else {
				$this->moduleRepository->updateById($id, $data);
			}
			session()->flash('success', trans('Updated successfully.'));
			DB::commit();
		} catch(Exception $exception) {
			session()->flash('error', trans('Updated error.'));
			DB::rollBack();
		}
	}

	public function delete($id)
	{
		DB::beginTransaction();
		try {
			$this->moduleRepository->deleteById($id);
			session()->flash('success', trans('Deleted successfully.'));
			DB::commit();
		} catch(Exception $exception) {
			session()->flash('error', trans('Deleted error.'));
			DB::rollBack();
		}
	}

	public function findBy($data = [])
	{
		return $this->moduleRepository->findBy($data);
	}

	/**
	 * @return void
	 */
	public function updateImages($id, $data)
	{
		$data['images'] = json_encode($data['images']);
		$data['images'] = replaceOldUrl($data['images']);
		$this->moduleRepository->detailById($id)->update($data);
	}
}
