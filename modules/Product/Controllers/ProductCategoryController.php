<?php

namespace Modules\Product\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Controllers\BaseController;
use Modules\Base\Models\Status;
use Modules\Product\Models\Product;
use Modules\Product\Requests\ProductCategoryRequest;
use Modules\Product\Services\ProductCategoryService;
use Modules\Role\Requests\RoleRequest;

class ProductCategoryController extends BaseController
{

	private $moduleService;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct(ProductCategoryService $moduleService)
	{
		$this->moduleService = $moduleService;
	}

	/**
	 * @param Request $request
	 *
	 * @return Factory|View
	 */
	public function index(Request $request)
	{
		$filter   = $request->all();
		$statuses = Status::getStatuses();
		$data     = $this->moduleService->list($filter);

		return view("Product::product_category.index", compact('data', 'filter', 'statuses'));
	}

	/**
	 * @return Application|Factory|View
	 */
	public function getCreate()
	{
		$categoryRecursiveOptions = getRecursiveProductCategoryOptions($this->moduleService->getArray(),
			NULL, NULL, NULL, NULL, 1);
		$statuses                 = Status::getStatuses();

		return view('Product::product_category.create',
			compact('categoryRecursiveOptions', 'statuses'));
	}

	/**
	 * @param ProductCategoryRequest $request
	 *
	 * @return RedirectResponse
	 */
	public function postCreate(ProductCategoryRequest $request)
	{
		$this->moduleService->create($request->all());

		return redirect()->route('get.product_category.list');
	}

	/**
	 * @param $id
	 *
	 * @return Application|Factory|View|RedirectResponse
	 */
	public function getUpdate($id)
	{
		$data = $this->moduleService->detail($id);
		if (empty($data)) {
			return redirect()->route('get.product_category.list');
		}
		$categoryRecursiveOptions = getRecursiveProductCategoryOptions($this->moduleService->getArray(),
			$data->parent_id, $data->id, NULL, NULL, 1);
		$statuses                 = Status::getStatuses();

		return view('Product::product_category.update',
			compact('data', 'statuses', 'categoryRecursiveOptions'));
	}

	/**
	 * @param RoleRequest $request
	 * @param $id
	 *
	 * @return RedirectResponse
	 */
	public function postUpdate(ProductCategoryRequest $request, $id)
	{
		$this->moduleService->update($id, $request->all());

		return redirect()->back();
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$this->moduleService->delete($id);

		return back();
	}

	public function view($id)
	{
		$data = $this->moduleService->detail($id);
		$products = [];
		$view = 'Frontend::product.category_page';
		if ($data->children->count() == 0) {
			$view = 'Frontend::product.product_listing';
			$products = Product::query()
			                   ->with('variants', 'category')
			                   ->whereJsonContains('product_category_ids',
				                   (string) $data->id)
			                   ->paginate(20);
		}

		return view($view, compact('data', 'products'));
	}
}
