<?php

namespace Modules\Product\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Controllers\BaseController;
use Modules\Base\Models\Status;
use Modules\Product\Requests\ProductAttributeRequest;
use Modules\Product\Services\ProductAttributeService;

class ProductAttributeController extends BaseController
{
    private $moduleService;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ProductAttributeService $moduleService)
    {
        $this->moduleService = $moduleService;
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

        return view("Product::product_attribute.index", compact('data', 'filter', 'statuses'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function getCreate(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }

	    $attributes = $this->moduleService->getArray();

        return view('Product::product_attribute._form', compact('attributes'));
    }

    /**
     * @param ProductAttributeRequest $request
     * @return RedirectResponse
     */
    public function postCreate(ProductAttributeRequest $request)
    {
        $this->moduleService->create($request->all());

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function getUpdate(Request $request, $id)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }
        $data = $this->moduleService->detail($id);
	    $children = ($data->children->count() > 0) ? $data->children->pluck('name', 'name') : [];

        return view('Product::product_attribute._form', compact('data', 'children'));
    }

    /**
     * @param ProductAttributeRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUpdate(ProductAttributeRequest $request, $id)
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
