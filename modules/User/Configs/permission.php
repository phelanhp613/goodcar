<?php
return [
	'name'         => 'user',
	'display_name' => 'User',
	'trans'        => trans('User'),
	'group'        => [
		[
			'name'         => 'user-create',
			'display_name' => 'Create User',
			'trans'        => trans('Create User'),
		],
		[
			'name'         => 'user-update',
			'display_name' => 'Update User',
			'trans'        => trans('Update User'),
		],
		[
			'name'         => 'user-delete',
			'display_name' => 'Delete User',
			'trans'        => trans('Delete User'),
		],
		[
			'name'         => 'update-user-role',
			'display_name' => 'Update User Role',
			'trans'        => trans('Update User Role'),
		],
	],
];
