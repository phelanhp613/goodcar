<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Modules\Permission\Models\Permission;
use Modules\Permission\Models\PermissionRole;

class AuthServiceProvider extends ServiceProvider
{

	protected string $permission_table = 'permissions';

	protected string $permission_roles_table = 'permission_role';

	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();
		Auth::shouldUse('admin');

		if(Schema::hasTable($this->permission_table) && Schema::hasTable($this->permission_roles_table)) {
			$permissions       = Permission::all();
			$permissionRolesDB = PermissionRole::query()->get();
			$permissionRoles   = [];
			foreach($permissionRolesDB as $item) {
				$permissionRoles[$item->role_id][] = $item->permission_id;
			}

			foreach($permissions as $permission) {
				Gate::define($permission->name,
					function($user) use ($permission, $permissionRoles) {
						$role_id = $user->role->id;

						return in_array($permission->id, $permissionRoles[$role_id]);
					});
			}
		}
	}
}
