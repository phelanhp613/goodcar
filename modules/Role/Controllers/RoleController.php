<?php

namespace Modules\Role\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Role\Models\Role;
use Modules\Role\Requests\RoleRequest;
use Modules\Base\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Modules\Role\Repositories\RoleService;

class RoleController extends BaseController
{
    private $roleInterface;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(RoleService $roleInterface)
    {
        $this->roleInterface = $roleInterface;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        $statuses = Status::getStatuses();
        $data = $this->roleInterface->list($filter);

        return view("Role::index", compact('data', 'filter', 'statuses'));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getCreate(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }
        $statuses = Status::getStatuses();

        return view('Role::_form', compact('statuses'))->render();
    }

    /**
     * @param RoleRequest $request
     * @return RedirectResponse
     */
    public function postCreate(RoleRequest $request)
    {
        $this->roleInterface->create($request->all());

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
        $statuses = Status::getStatuses();
        $role = $this->roleInterface->detail($id);

        return view('Role::_form', compact('role', 'statuses'));
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUpdate(RoleRequest $request, $id)
    {
        $this->roleInterface->update($id, $request->all());

        return redirect()->back();
    }

    public function delete($id)
    {
        $this->roleInterface->delete($id);

        return back();
    }
}
