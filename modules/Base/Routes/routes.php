<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Modules\Base\Controllers\BaseController;

Route::get('/change-locale/{key}', 'BaseController@changeLocale')->name('system.change_locale');
Route::get('/sitemap.xml', [BaseController::class, 'generateSitemap']);

Route::middleware('admin')->prefix("admin")->group(function() {
	Route::post('/remove-file', 'BaseController@removeFile')->name('system.remove_file');
});

Route::get('/lalala', function() {
	Artisan::call('route:clear');
	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('view:clear');
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, max-age=0');
	cacheData();

	session()->flash('success', trans("Cache is cleared"));

	return redirect()->back();
})->name('system.clear.cache');

