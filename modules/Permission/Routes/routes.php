<?php

use Illuminate\Support\Facades\Route;

Route::middleware('admin')->prefix("admin")->group(function () {
    Route::prefix("permission")->group(function () {
        Route::get("/", "PermissionController@index")->name("get.permission.list")->can('permission');
        Route::post('/', 'PermissionController@postUpdate')->name('post.permission.update')->can('permission-update');
    });
});
