<?php
return [
    'name' => trans('Tag'),
    'route' => route('get.tag.list'),
    'sort' => 10,
    'active'=> TRUE,
    'id'=> 'tag',
    'icon' => '<i class="mdi mdi-account-key"></i>',
    'middleware' => ['tag'],
    'group' => []
];
