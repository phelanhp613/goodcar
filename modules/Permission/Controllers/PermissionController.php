<?php

namespace Modules\Permission\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Permission\Models\Permission;
use Modules\Permission\Models\PermissionRole;
use Modules\Role\Models\Role;

class PermissionController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        # parent::__construct();
    }

    public function index(Request $request) {
        $permissions = Permission::with('child')->where('parent_id', 0)->orderBy('display_name', 'ASC')->get();
        $roles       = Role::query()->orderBy('name', 'ASC')->get();
		$permissionRolesDB = PermissionRole::query()->get();
	    $permissionRoles = [];
		foreach($permissionRolesDB as $item) {
			$permissionRoles[$item->role_id][] = $item->permission_id;
		}

	    return view('Permission::index', compact('permissions', 'roles', 'permissionRoles'));
    }

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdate(Request $request) {
		$insert_data = $request->role_permission;

		if (!empty($insert_data)) {
			foreach ($insert_data as $key => $datum) {
				$role = Role::query()->find($key);
				$role->permissions()->sync($datum);
			}
		}

		$request->session()->flash('success', trans('Access control updated successfully.'));

		return redirect()->back();
	}

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postUpdateOld(Request $request) {
        $insert_data = $request->role_permission;

        if (!empty($insert_data)) {
            foreach ($insert_data as $key => $datum) {
                $role = Role::query()->find($key);
                $role->permissions()->sync($datum);
                foreach ($datum as $item) {
                    $permission = Permission::find($item);
                    if ($permission->parent_id != 0) {
                        if (!PermissionRole::checkRolePermission($permission->parent->id, $key)) {
                            PermissionRole::query()->firstOrCreate([
                                'role_id'       => $key,
                                'permission_id' => $permission->parent->id
                            ]);
                        }
                    }
                }
            }

            $roles = Role::query()->whereNotIn('id', array_keys($insert_data))->get();
        }else{
            $roles = Role::query()->get();
        }


        foreach ($roles as $role){
            if ($role->id != Role::getAdminRole()->id){
                $role->permissions()->sync([]);
            }
        }

        $request->session()->flash('success', trans('Access control updated successfully.'));

        return redirect()->back();
    }
}
