<?php

use Illuminate\Support\Facades\Route;
use Modules\Tag\Controllers\TagController;

Route::middleware('admin')->prefix("admin")->group(function () {
    Route::prefix("tag")->group(function () {
        Route::get('/', [TagController::class, 'index'])->name("get.tag.list")->can('tag');
        Route::middleware('can:tag-create')->group(function () {
            Route::get("create", [TagController::class, 'getCreate'])->name("get.tag.create");
            Route::post("create", [TagController::class, 'postCreate'])->name("post.tag.create");
        });
        Route::middleware('can:tag-update')->group(function () {
            Route::get("update/{id}", [TagController::class, 'getUpdate'])->name("get.tag.update");
            Route::post("update/{id}", [TagController::class, 'postUpdate'])->name("post.tag.update");
        });
        Route::get("delete/{id}", [TagController::class, 'delete'])->name("get.tag.delete")->can('tag-delete');
    });
});
