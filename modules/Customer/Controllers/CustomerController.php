<?php

namespace Modules\Customer\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Customer\Models\Customer;
use Modules\Customer\Requests\CustomerRequest;
use Modules\Base\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Modules\Customer\Repositories\CustomerService;
use Modules\Order\Repositories\OrderService;

class CustomerController extends BaseController
{
    private $moduleService;

	private $orderService;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(CustomerService $moduleService, OrderService $orderService)
    {
        $this->moduleService = $moduleService;
	    $this->orderService = $orderService;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        $statuses = Status::getStatuses();
        $data = $this->moduleService->list($filter);

        return view("Customer::index", compact('data', 'filter', 'statuses'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function getUpdate(Request $request, $id)
    {
        $statuses = Status::getStatuses();
        $data = $this->moduleService->detail($id);
		$orders = $this->orderService->list(['phone' => $data->phone]);

        return view('Customer::update', compact('data', 'statuses', 'orders'));
    }

    /**
     * @param CustomerRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUpdate(CustomerRequest $request, $id)
    {
        $this->moduleService->update($id, $request->all());

        return redirect()->back();
    }

    public function delete($id)
    {
        $this->moduleService->delete($id);

        return back();
    }
}
