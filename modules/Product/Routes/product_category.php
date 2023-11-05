<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Controllers\ProductCategoryController;

Route::middleware('admin')->prefix("admin")->group(function () {
    Route::prefix("product")->group(function () {
        Route::prefix("product-category")->group(function () {
            Route::get("/", [ProductCategoryController::class, "index"])->name("get.product_category.list")->can('product-category');
            Route::middleware('can:product-category-create')->group(function () {
                Route::get("create", [ProductCategoryController::class, "getCreate"])->name("get.product_category.create");
                Route::post("create", [ProductCategoryController::class, "postCreate"])->name("post.product_category.create");
            });
            Route::middleware('can:product-category-update')->group(function () {
                Route::get("update/{id}", [ProductCategoryController::class, "getUpdate"])->name("get.product_category.update");
                Route::post("update/{id}", [ProductCategoryController::class, "postUpdate"])->name("post.product_category.update");
            });
            Route::get("delete/{id}", [ProductCategoryController::class, "delete"])->name("get.product_category.delete")->can('product-category-delete');
        });
    });
});
Route::get('/view/product-category/{id}', [ProductCategoryController::class, "view"])->name('get.product_category.view');