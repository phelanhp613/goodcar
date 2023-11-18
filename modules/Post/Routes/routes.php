<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Controllers\PostController;

Route::middleware('admin')->prefix("admin")->group(function () {
    Route::prefix("post")->group(function () {
        Route::get("/", "PostController@index")->name("get.post.list")->can('post');
        Route::middleware('can:post-create')->group(function () {
            Route::get("create", [PostController::class, "getCreate"])->name("get.post.create");
            Route::post("create", [PostController::class, "postCreate"])->name("post.post.create");
        });
        Route::middleware('can:post-update')->group(function () {
            Route::get("update/{id}", "PostController@getUpdate")->name("get.post.update");
            Route::post("update/{id}", "PostController@postUpdate")->name("post.post.update");
        });
        Route::get("delete/{id}", "PostController@delete")->name("get.post.delete")->can('post-delete');
    });
});
