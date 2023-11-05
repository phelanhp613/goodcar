<?php

namespace Modules\Setting\Repositories;

use Exception;
use Illuminate\Support\Str;
use Modules\Base\Repositories\BaseServiceInterface;
use Modules\Setting\Models\Website;

class MenuService implements BaseServiceInterface
{

	private $moduleRepository;

	public function __construct(MenuRepository $moduleRepository)
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
			$data['slug'] = Str::slug(!empty($data['slug']) ? $data['slug'] : $data['name']);
			$this->moduleRepository->create($data);
			session()->flash('success', trans('Created successfully.'));
		} catch (Exception $exception) {
			session()->flash('error', trans('Created error.'));
		}
	}

	public function update($id, $data)
	{
		try {
			$data['slug'] = Str::slug(!empty($data['slug']) ? $data['slug'] : $data['name']);
			$this->moduleRepository->updateById($id, $data);
			$setting_menus = Website::query()
			                        ->where([
				                        'key'   => 'MENU_HEADER',
				                        'value' => $id
			                        ])
			                        ->orWhere([
				                        'key'   => 'MENU_BACKEND',
				                        'value' => $id
			                        ])->get();
			foreach ($setting_menus as $setting_menu) {
				$data = [
					'key'     => $setting_menu->key,
					'value'   => $id,
					'content' => $data['content']
				];
				$setting_menu->update($data);
			}
			session()->flash('success', trans('Updated successfully.'));
		} catch (Exception $exception) {
			session()->flash('error', trans('Updated error.'));
		}
	}

	public function detail($id)
	{
		return $this->moduleRepository->detailById($id);
	}

	public function delete($id)
	{
		try {
			$this->moduleRepository->deleteById($id);
			session()->flash('success', trans('Deleted successfully.'));
		} catch (Exception $exception) {
			session()->flash('error', trans('Deleted error.'));
		}
	}
}
