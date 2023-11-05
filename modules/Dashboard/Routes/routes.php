<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\Controllers\DashboardController;

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get("/", [DashboardController::class, "index"])->name("admin.dashboard");
	Route::get("sms/test", function() {
		$smsService = new \App\Commons\SMS\Services\CMCSMSService();
		$smsService->to('0364669813')
		                     ->message('Test')
		                     ->messageID('ctybasics2_test')
		                     ->sendNormal();
	});
	Route::get("sms/status/{id}", function($id) {
		$smsService = new \App\Commons\SMS\Services\CMCSMSService();
		$smsService->getStatusSMS($id);
	});
});
