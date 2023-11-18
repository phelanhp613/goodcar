<?php
return [
    'name' => trans('Post'),
    'route' => route('get.post.list'),
    'sort' => 6,
    'active' => TRUE,
    'id' => 'post',
    'icon' => '<i class="fa fa-user-friends"></i>',
    'middleware' => ['post'],
    'group' => []
];
