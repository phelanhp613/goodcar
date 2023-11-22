<?php
return [
    'name' => trans('Order'),
    'route' => route('get.order.list'),
    'sort' => 6,
    'active'=> TRUE,
    'id'=> 'order',
    'icon' => '<i class="fa fa-file-invoice-dollar"></i>',
    'middleware' => ['order'],
    'group' => [
	    [
		    'id'         => 'order',
		    'name'       => trans('Order'),
		    'route'      => route('get.order.list'),
		    'middleware' => ['order'],
	    ],
	    [
		    'id'         => 'order-sold-product',
		    'name'       => trans('Sold Product'),
		    'route'      => route('get.order.sold_product_list'),
		    'middleware' => ['order'],
	    ],
    ]
];
