<?php
return [
    'name' => trans('Order'),
    'route' => route('get.order.list'),
    'sort' => 6,
    'active'=> TRUE,
    'id'=> 'order',
    'icon' => '<i class="fa fa-file-invoice-dollar"></i>',
    'middleware' => ['order'],
    'group' => []
];
