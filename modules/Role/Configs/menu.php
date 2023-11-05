<?php
return [
    'name' => trans('Role'),
    'route' => route('get.role.list'),
    'sort' => 97,
    'active'=> FALSE,
    'id'=> 'role',
    'icon' => '<i class="fa-solid fa-shield-keyhole"></i>',
    'middleware' => ['role'],
    'group' => []
];
