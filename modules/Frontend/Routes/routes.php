<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Controllers\FrontendController;
use Modules\Frontend\Controllers\FrontendOrderController;


Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('404', [FrontendController::class, 'pageNotFound'])->name('frontend.pageNotFound');

Route::prefix('order')->group(function() {
	Route::get('/', [FrontendOrderController::class, 'getOrder'])->name('frontend.get.order');
	Route::post('/', [FrontendOrderController::class, 'postOrder'])->name('frontend.post.order');
	Route::get('/search', [FrontendOrderController::class, 'orderSearch'])
	     ->name('frontend.get.orderSearch');
	Route::get('/detail/{id}', [FrontendOrderController::class, 'orderDetail'])
	     ->name('frontend.get.orderDetail');
	Route::get('/completed/{code}', [FrontendOrderController::class, 'orderCompleted'])
	     ->name('frontend.order.completed');
});

Route::get('/tim-kiem-san-pham', [FrontendController::class, 'searchProduct'])
     ->name('frontend.product.search');
Route::get('/news', [FrontendController::class, 'news'])
     ->name('frontend.post.news');
Route::get('/uoc-tinh-chi-phi', [FrontendController::class, 'costEstimate'])
     ->name('frontend.get.costEstimate');
Route::get('/{slug}', [FrontendController::class, 'redirectToPage'])
     ->name('frontend.redirect_to_page');
