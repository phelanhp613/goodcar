<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Role\Repositories\RoleService;
use Modules\User\Repositories\UserService;
use Modules\User\Requests\UserRequest;

class UserController extends Controller
{
    protected $moduleService;
    protected $roles = [];
    protected $statuses = [];

    public function __construct(UserService $moduleService, RoleService $roleService)
    {
        $this->moduleService = $moduleService;
        $this->roles = $roleService->getArray();
        $this->statuses = Status::getStatuses();
    }

    /**
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $data = $this->moduleService->list($request->all());

        return view('User::index', [
            'data'     => $data,
            'filter'   => $request->all(),
            'statuses' => $this->statuses,
            'roles'    => $this->roles,
        ]);
    }

    /**
     * @return Factory|View
     */
    public function getCreate()
    {
        return view('User::create', [
            'statuses' => $this->statuses,
            'roles'    => $this->roles,
        ]);
    }

    /**
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function postCreate(UserRequest $request)
    {
        $this->moduleService->create($request->all());

        return redirect()->route('get.user.list');
    }

    /**
     * @return Factory|View
     */
    public function getUpdate($id)
    {
        $data = $this->moduleService->detail($id);

        return view('User::update', [
            'data'     => $data,
            'statuses' => $this->statuses,
            'roles'    => $this->roles,
        ]);
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUpdate(UserRequest $request, $id)
    {
        $this->moduleService->update($id, $request->all());

        return redirect()->back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $this->moduleService->delete($id);

        return redirect()->back();
    }

	/**
	 * @return Factory|View
	 */
	public function getProfile()
	{
		$data = $this->moduleService->detail(auth('admin')->id());

		return view('User::profile', [
			'data'     => $data,
			'statuses' => $this->statuses,
			'roles'    => $this->roles,
		]);
	}

	/**
	 * @param UserRequest $request
	 * @param $id
	 * @return RedirectResponse
	 */
	public function postProfile(UserRequest $request)
	{
		$this->moduleService->update(auth()->id('admin'), $request->all());

		return redirect()->back();
	}
}
