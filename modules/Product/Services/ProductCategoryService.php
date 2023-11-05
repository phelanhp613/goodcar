<?php

namespace Modules\Product\Services;

use Exception;
use Modules\Base\Components\TextareaContentTab;
use Modules\Base\Repositories\BaseServiceInterface;
use Modules\Product\Repositories\ProductCategoryRepository;

class ProductCategoryService implements BaseServiceInterface
{
	private $moduleRepository;

	public function __construct(ProductCategoryRepository $moduleRepository)
	{
		$this->moduleRepository = $moduleRepository;
	}

	public function getArray()
	{
		return $this->moduleRepository->getArray();
	}

	public function list($data)
	{
		return $this->moduleRepository->paginate($data);
	}

	public function create($data)
	{
		try {
			$data['home_name'] = !empty($data['home_name']) ? $data['home_name'] : $data['name'];
			$data['level'] = 0;
			if(!empty($data['parent_id'])) {
				$parent        = $this->moduleRepository->detailById($data['parent_id']);
				$data['level'] = (int) $parent->level + 1;
			} else {
				$data['parent_id'] = null;
			}
			$data['content'] = json_encode(TextareaContentTab::setContent($data['content'] ?? []));
			$data['content'] = replaceOldUrl($data['content']);
			$this->moduleRepository->create($data);
			session()->flash('success', trans('Created successfully.'));
		} catch(Exception $exception) {
			session()->flash('error', trans('Created error.'));
		}
	}

	public function detail($id)
	{
		return $this->moduleRepository->detailById($id);
	}

	public function update($id, $data)
	{
		try {
			$data['home_name'] = !empty($data['home_name']) ? $data['home_name'] : $data['name'];
			$data['level'] = 0;
			if(!empty($data['parent_id'])) {
				$parent        = $this->moduleRepository->detailById($data['parent_id']);
				$data['level'] = (int) $parent->level + 1;
			} else {
				$data['parent_id'] = null;
			}
			$data['content']   = json_encode(TextareaContentTab::setContent($data['content'] ?? []));
			$data['content']   = replaceOldUrl($data['content']);
			$data['parent_id'] = !empty($data['parent_id']) ? $data['parent_id'] : null;
			$this->moduleRepository->updateById($id, $data);
			session()->flash('success', trans('Updated successfully.'));
		} catch(Exception $exception) {
			session()->flash('error', trans('Updated error.'));
		}
	}

	public function delete($id)
	{
		try {
			$data = $this->moduleRepository->detailById($id);
			if($data->products->count() > 0 || $data->children->count() > 0) {
				session()->flash('error', trans('Something is using this data.'));
			} else {
				$data->delete();
				session()->flash('success', trans('Deleted successfully.'));
			}
			session()->flash('success', trans('Deleted successfully.'));
		} catch(Exception $exception) {
			session()->flash('error', trans('Deleted error.'));
		}
	}
}
