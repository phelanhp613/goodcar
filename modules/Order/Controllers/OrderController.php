<?php

namespace Modules\Order\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Controllers\BaseController;
use Modules\Order\Models\Order;
use Modules\Order\Repositories\OrderService;
use Modules\Order\Requests\OrderRequest;

class OrderController extends BaseController
{
	private $moduleService;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct(OrderService $moduleService)
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
		$filters = $request->all();
		$statues = Order::getStatuses();
		$data    = $this->moduleService->list($filters);

		return view("Order::index", compact('data', 'statues', 'filters'));
	}

	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @return Application|Factory|View|RedirectResponse
	 */
	public function getUpdate(Request $request, $id)
	{
		$data    = $this->moduleService->detail($id);
		$statues = Order::getStatuses();

		return view('Order::update', compact('data', 'statues'));
	}

	/**
	 * @param \Modules\Order\Requests\OrderRequest $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdate(OrderRequest $request, $id)
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

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function accept($id)
	{
		$this->moduleService->accept($id);

		return back();
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function abort($id)
	{
		$this->moduleService->abort($id);

		return back();
	}

	/**
	 * @param $id
	 * @param $detail_id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deleteDetail($id, $detail_id)
	{
		$this->moduleService->deleteDetail($id, $detail_id);

		return back();
	}

	public function getUpdateDetail($id)
	{
		$data = $this->moduleService->orderDetail($id);

		return view('Order::_form_update_detail', compact('data'));
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdateDetail(Request $request, $id)
	{
		$this->moduleService->updateDetail($id, $request->all());

		return back();
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function getSoldProductListing(Request $request)
	{
		$filters = $request->all();
		$data = $this->moduleService->getOrderDetailList($filters);

		return view('Order::sold_product_listing', compact('data', 'filters'));
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function getSoldProductDetail($id)
	{
		$data = $this->moduleService->orderDetail($id);

		return view('Order::sold_product_detail', compact('data'));
	}

	/**
	 * @param $id
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postSoldProductDetail($id, Request $request)
	{
		$this->moduleService->updateOrderDetail($id, $request->all());

		return back();
	}
}
