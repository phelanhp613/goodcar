<?php

namespace Modules\Base\Consoles;

use Illuminate\Console\Command;
use Modules\Permission\Models\Permission;
use Modules\Role\Models\Role;

class PermissionCommand extends Command
{

	protected $list_permission = [];

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'permissions:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'The systems will setup Role Module';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$permissions = config_permission_merge();
		/** Insert permission list */
		foreach($permissions as $value) {
			if(!isset($value['name'])) {
				foreach($value as $item) {
					self::updatePermission($item);
				}
			} else {
				self::updatePermission($value);
			}
		}

		/** Delete permission not exist*/
		$permission_del = array_diff(Permission::query()->pluck('name')->toArray(),
			$this->list_permission);
		Permission::query()->whereIn('name', $permission_del)->delete();

		$db_permissions = Permission::query()->pluck('id');
		$admin_role     = Role::getAdminRole();
		$admin_role->permissions()->sync($db_permissions);

		$this->info('Update Permission Successfully');
	}

	/**
	 * @param $value
	 */
	public function updatePermission($value)
	{
		$data                              = [
			'name'      => trim($value['name']),
			'parent_id' => 0,
		];
		$dataValue                         = [
			'display_name' => ucwords($value['display_name']),
		];
		$group                             = Permission::query()->firstOrCreate($data, $dataValue);
		$this->list_permission[$group->id] = $group->name;
		if(isset($value['group']) && count($value['group']) > 0) {
			foreach($value['group'] as $sub) {
				$childDataValue                         = [
					'display_name' => ucwords($sub['display_name']),
				];
				$child = Permission::query()->firstOrCreate([
					'name'         => trim($sub['name']),
					'parent_id'    => $group->id,
				], $childDataValue);

				$this->list_permission[$child->id] = $child->name;
			}
		}
	}
}
