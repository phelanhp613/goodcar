<?php
return [
    'name' => trans('Setting'),
    'route' => route('get.setting.list'),
    'sort' => 99,
    'active'=> TRUE,
    'id'=> 'setting',
    'icon' => '<i class="fa fa-cog"></i>',
    'middleware' => ['setting'],
    'group' => [
        [
            'id'         => 'setting',
            'name'       => trans('Settings'),
            'route'      => route('get.setting.list'),
            'middleware' => [],
        ],
        [
            'id'         => 'file-management',
            'name'       => trans('File Management'),
            'route'      => route('setting.file-management'),
            'middleware' => [],
        ]
    ]
];
