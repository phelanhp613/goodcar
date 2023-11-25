<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Controllers\OrderController;

Route::middleware('admin')->prefix("admin")->group(function() {
	Route::prefix("order")->group(function() {
		Route::get('/', [OrderController::class, 'index'])->name("get.order.list")->can('order');
		Route::middleware('can:order-update')->group(function() {
			Route::get("update/{id}", [OrderController::class, 'getUpdate'])
			     ->name("get.order.update");
			Route::post("update/{id}", [OrderController::class, 'postUpdate'])
			     ->name("post.order.update");
			Route::get("accept/{id}", [OrderController::class, 'accept'])->name("get.order.accept");
			Route::get("abort/{id}", [OrderController::class, 'abort'])->name("get.order.abort");
			Route::get("delete-detail/{id}/{detail_id}", [OrderController::class, 'deleteDetail'])
			     ->name("get.order.deleteDetail");
			Route::get("update-detail/{id}", [OrderController::class, 'getUpdateDetail'])
			     ->name("get.order.updateDetail");
			Route::post("update-detail/{id}", [OrderController::class, 'postUpdateDetail'])
			     ->name("post.order.updateDetail");
		});
		Route::get('/print/{id}', [OrderController::class, 'getPrintOrder'])->name("get.order.print")->can('order');
		Route::get("delete/{id}", [OrderController::class, 'delete'])
		     ->name("get.order.delete")
		     ->can('order-delete');

		Route::get('sold-product', [OrderController::class, 'getSoldProductListing'])
		     ->name('get.order.sold_product_list')
		     ->can('order');
		Route::get('sold-product/{id}', [OrderController::class, 'getSoldProductDetail'])
		     ->name('get.order.sold_product_detail')
		     ->can('order-update');
		Route::post('sold-product/{id}', [OrderController::class, 'postSoldProductDetail'])
		     ->name('post.order.sold_product_detail')
		     ->can('order-update');
	});
});
