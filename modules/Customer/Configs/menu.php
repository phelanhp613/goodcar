<?php
return [
    'name' => trans('Customer'),
    'route' => route('get.customer.list'),
    'sort' => 6,
    'active'=> TRUE,
    'id'=> 'customer',
    'icon' => '<i class="fa fa-user-friends"></i>',
    'middleware' => ['customer'],
    'group' => []
];
