<?php
return [
    'name' => trans('Access Control'),
    'route' => route('get.permission.list'),
    'sort' => 98,
    'active'=> FALSE,
    'id'=> 'permission',
    'icon' => '<i class="fab fa-delicious"></i>',
    'middleware' => ['permission'],
    'group' => []
];
