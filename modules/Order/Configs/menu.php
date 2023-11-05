<?php
return [
    'name' => trans('Order'),
    'route' => route('get.order.list'),
    'sort' => 6,
    'active'=> TRUE,
    'id'=> 'order',
    'icon' => '',
    'middleware' => ['order'],
    'group' => []
];
