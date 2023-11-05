<?php

namespace Modules\Tag\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Controllers\BaseController;
use Modules\Base\Models\Status;
use Modules\Role\Requests\RoleRequest;
use Modules\Tag\Repositories\TagService;
use Modules\Tag\Requests\TagRequest;

class TagController extends BaseController
{
    private $moduleService;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(TagService $moduleService)
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

        return view("Tag::index", compact('data', 'filter', 'statuses'));
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

        return view('Tag::_form');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function postCreate(TagRequest $request)
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

        return view('Tag::_form', compact('data'));
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUpdate(TagRequest $request, $id)
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
