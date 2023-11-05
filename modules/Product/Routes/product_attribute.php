<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Controllers\ProductAttributeController;

Route::middleware('admin')->prefix("admin")->group(function () {
    Route::prefix("product")->group(function () {
        Route::prefix("product-attribute")->group(function () {
            Route::get("/", [ProductAttributeController::class, "index"])->name("get.product_attribute.list")->can('product-attribute');
            Route::middleware('can:product-attribute-create')->group(function () {
                Route::get("create", [ProductAttributeController::class, "getCreate"])->name("get.product_attribute.create");
                Route::post("create", [ProductAttributeController::class, "postCreate"])->name("post.product_attribute.create");
            });
            Route::middleware('can:product-attribute-update')->group(function () {
                Route::get("update/{id}", [ProductAttributeController::class, "getUpdate"])->name("get.product_attribute.update");
                Route::post("update/{id}", [ProductAttributeController::class, "postUpdate"])->name("post.product_attribute.update");
            });
            Route::get("delete/{id}", [ProductAttributeController::class, "delete"])->name("get.product_attribute.delete")->can('product-attribute-delete');
        });
    });
});
