<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Controllers\ProductController;

Route::middleware('admin')->prefix("admin")->group(function () {
    Route::prefix("product")->middleware('can:product')->group(function () {
        Route::get('/', [ProductController::class, "index"])->name('get.product.list');
        Route::middleware('can:product-create')->group(function () {
            Route::get('/create', [ProductController::class, "getCreate"])->name('get.product.create');
            Route::post('/create', [ProductController::class, "postCreate"])->name('post.product.create');
        });
        Route::middleware('can:product-update')->group(function () {
            Route::get('/update/{id}', [ProductController::class, "getUpdate"])->name('get.product.update');
            Route::post('/update/{id}', [ProductController::class, "postUpdate"])->name('post.product.update');
            Route::get('/add-attribute-input', [ProductController::class, "addAttributeInput"])->name('get.product.addAttributeInput');
	        Route::post('/add-attribute/{id}', [ProductController::class, "postAddAttribute"])->name('get.product.postAddAttribute');
	        Route::post('/add-image/{id}', [ProductController::class, "postAddImage"])->name('post.product.add_image');
	        Route::post('/update-featured', [ProductController::class, "postUpdateProductFeatured"])->name('post.product.update_featured');
        });
        Route::get('/delete/{id}', [ProductController::class, "delete"])->name('get.product.delete')->can('product-delete');
    });
});
Route::get('/view/product/{id}', [ProductController::class, "view"])->name('get.product.view');
Route::get('product/product-find', [ProductController::class, 'find'])->name('get.product.find');