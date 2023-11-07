<?php

use Illuminate\Support\Facades\Route;

Route::middleware('admin')->prefix("admin")->group(function () {
    Route::prefix("customer")->group(function () {
        Route::get("/", "CustomerController@index")->name("get.customer.list")->can('customer');
        Route::middleware('can:customer-create')->group(function () {
            Route::get("create", "CustomerController@getCreate")->name("get.customer.create");
            Route::post("create", "CustomerController@postCreate")->name("post.customer.create");
        });
        Route::middleware('can:customer-update')->group(function () {
          Route::get("update/{id}", "CustomerController@getUpdate")->name("get.customer.update");
           Route::post("update/{id}", "CustomerController@postUpdate")->name("post.customer.update");
        });
        Route::get("delete/{id}", "CustomerController@delete")->name("get.customer.delete")->can('customer-delete');
    });
});
