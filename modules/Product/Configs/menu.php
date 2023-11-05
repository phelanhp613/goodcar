<?php
return [
    'name'       => trans('Product'),
    'route'      => 'javascript:',
    'sort'       => 4,
    'active'     => true,
    'id'         => 'product',
    'icon'       => '<i class="mdi mdi-account-key"></i>',
    'middleware' => ['product'],
    'group'      => [
        [
            'id'         => 'product-category',
            'name'       => trans('Product Category'),
            'route'      => route('get.product_category.list'),
            'middleware' => ['product-category'],
        ],
        [
            'id'         => 'product-attribute',
            'name'       => trans('Product Attribute'),
            'route'      => route('get.product_attribute.list'),
            'middleware' => ['product-attribute'],
        ],
        [
            'id'         => 'product',
            'name'       => trans('Product'),
            'route'      => route('get.product.list'),
            'middleware' => ['product'],
        ],
    ],
];
