<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Controllers\FrontendController;
use Modules\Frontend\Controllers\FrontendOrderController;

Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('404', [FrontendController::class, 'pageNotFound'])->name('frontend.pageNotFound');

Route::get('/order-now/{slug}', [FrontendOrderController::class, 'getOrderNow'])
     ->name('frontend.get.order_now');
Route::get('/order', [FrontendOrderController::class, 'getOrder'])
     ->name('frontend.get.order');
Route::post('/order', [FrontendOrderController::class, 'postOrder'])
     ->name('frontend.post.order');
Route::get('/order/confirm-order/{code}', [FrontendOrderController::class, 'orderConfirm'])
     ->name('frontend.order.confirm');
Route::post('/order/confirm-order/{code}', [FrontendOrderController::class, 'postOrderConfirm'])
     ->name('frontend.post.order.confirm');
Route::get('/order/abort-order/{code}', [FrontendOrderController::class, 'orderAbort'])
     ->name('frontend.order.abort');
Route::get('/order/completed/{code}', [FrontendOrderController::class, 'orderCompleted'])
     ->name('frontend.order.completed');
Route::get('/order/resend-sms/{code}', [FrontendOrderController::class, 'resendSMS'])
     ->name('frontend.order.resendSMS');

Route::get('/tin-tuc', [FrontendController::class, 'news'])->name('frontend.get.news');
Route::get('/tu-van', [FrontendController::class, 'getConsult'])->name('frontend.get.consult');
Route::get('/bao-hanh-dien-tu', [FrontendController::class, 'getWarranty'])->name('frontend.get.warranty');
Route::get('/tiem-kiem', [FrontendController::class, 'searchProduct'])->name('frontend.product.search');
	Route::get('/flashsale', [FrontendController::class, 'flashSale'])->name('frontend.product.flashsale');
// Route::get('/contact-us', [FrontendController::class, 'getContact'])->name('frontend.get.contact');
Route::post('/contact-us', [FrontendController::class, 'postContact'])->name('frontend.post.contact');

Route::get('/{slug}', [FrontendController::class, 'redirectToPage'])
     ->name('frontend.redirect_to_page');
