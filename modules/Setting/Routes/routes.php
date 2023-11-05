<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\Controllers\MenuController;

Route::prefix("admin")->middleware('admin')->group(function () {
	Route::prefix("setting")->middleware('can:setting')->group(function () {
		Route::prefix('file-management')->group(function () {
			Route::get('/', "ElfinderController@index")->name('setting.file-management');
			Route::get('/ckeditor4', "ElfinderController@CKEditorIndex")
			     ->name('setting.elfinder.ckeditor4');
		});

		Route::get("/", "SettingController@index")->name("get.setting.list");
		Route::get("/email", "SettingController@emailConfig")->name("get.setting.emailConfig");
		Route::post("/email", "SettingController@emailConfig")->name("post.setting.emailConfig");
		Route::get("/test-email", "SettingController@testSendMail")
		     ->name("get.setting.testSendMail");
		Route::get("/website", "SettingController@websiteConfig")
		     ->name("get.setting.websiteConfig");
		Route::post("/website", "SettingController@websiteConfig")
		     ->name("post.setting.websiteConfig");
		Route::post("/point-exchange", "SettingController@pointExchange")
		     ->name("post.setting.pointExchange");
		Route::prefix('payment')->group(function () {
			Route::get("/", "SettingController@paymentConfig")
			     ->name("get.setting.paymentConfig");
			Route::post("/", "SettingController@paymentConfig")
			     ->name("post.setting.paymentConfig");
		});
		Route::get("/zalo-setting", "SettingController@zaloNotifyConfig")
		     ->name("get.setting.zaloNotifyConfig");
		Route::post("/zalo-setting", "SettingController@zaloNotifyConfig")
		     ->name("post.setting.zaloNotifyConfig");
	});
});
