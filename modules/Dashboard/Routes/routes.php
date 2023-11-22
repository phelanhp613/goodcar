<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\Controllers\DashboardController;

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get("/", [DashboardController::class, "index"])->name("admin.dashboard");
});
