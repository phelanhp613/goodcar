<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Controllers\ProductVariantController;

Route::middleware('admin')->prefix("admin")->group(function() {
	Route::prefix("product-variant")->middleware('can:product')->group(function() {
		Route::get('/{id}', [ProductVariantController::class, 'list'])
		     ->name('get.product_variant.list');
		Route::post('/{id}', [ProductVariantController::class, 'postQuickUpdate'])
		     ->name('post.product_variant.quickUpdate');
		Route::get('update/{id}', [ProductVariantController::class, 'getUpdate'])
		     ->name('get.product_variant.update');
		Route::post('update/{id}', [ProductVariantController::class, 'postUpdate'])
		     ->name('post.product_variant.update');
		Route::get('delete/{id}', [ProductVariantController::class, 'delete'])
		     ->name('get.product_variant.delete');
		Route::post('update-attribute/{id}', [ProductVariantController::class, 'updateAttribute'])
		     ->name('post.product_variant.updateAttribute');
		Route::post('/add-image/{id}', [ProductVariantController::class, "postAddImage"])
		     ->name('post.product_variant.add_image');
	});
});

Route::get('product/product-variant-find', [ProductVariantController::class, 'find'])->name('get.product_variant.find');