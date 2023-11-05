<?php
return [
    'name' => trans('User'),
    'route' => route('get.user.list'),
    'sort' => 96,
    'active'=> TRUE,
    'id'=> 'user',
    'icon' => '<i class="fa fa-users"></i>',
    'middleware' => ['user'],
    'group'      => [
	    [
		    'id'         => 'user',
		    'name'       => trans('User'),
		    'route'      => route('get.user.list'),
		    'middleware' => ['user'],
	    ],
		[
			'id'         => 'role',
			'name'       => trans('Role'),
			'route'      => route('get.role.list'),
			'middleware' => ['role'],
		],
		[
			'id'         => 'permission',
			'name'       => trans('Access Control'),
			'route'      => route('get.permission.list'),
			'middleware' => ['permission'],
		],
	],
];
