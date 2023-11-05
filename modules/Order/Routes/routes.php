<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Controllers\OrderController;

Route::middleware('admin')->prefix("admin")->group(function () {
    Route::prefix("order")->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name("get.order.list")->can('order');
        Route::middleware('can:order-update')->group(function () {
            Route::get("update/{id}", [OrderController::class, 'getUpdate'])->name("get.order.update");
            Route::post("update/{id}", [OrderController::class, 'postUpdate'])->name("post.order.update");
	        Route::get("accept/{id}", [OrderController::class, 'accept'])->name("get.order.accept");
	        Route::get("abort/{id}", [OrderController::class, 'abort'])->name("get.order.abort");
	        Route::get("delete-detail/{id}/{detail_id}", [OrderController::class, 'deleteDetail'])->name("get.order.deleteDetail");
	        Route::get("update-detail/{id}", [OrderController::class, 'getUpdateDetail'])->name("get.order.updateDetail");
	        Route::post("update-detail/{id}", [OrderController::class, 'postUpdateDetail'])->name("post.order.updateDetail");
        });
        Route::get("delete/{id}", [OrderController::class, 'delete'])->name("get.order.delete")->can('order-delete');
    });
});
