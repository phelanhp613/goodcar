<?php

use Illuminate\Support\Facades\Route;

Route::get('register', 'AuthMemberController@getRegister')->name('get.home.register');
Route::post('register', 'AuthMemberController@postRegister')->name('post.home.register');

Route::get('login', 'AuthMemberController@login')->name('get.home.login');
Route::post('login', 'AuthMemberController@login')->name('post.home.login');

Route::get('logout', 'AuthMemberController@logout')->name('get.home.logout');

Route::get('forgot-password', 'AuthMemberController@forgotPassword')->name('get.home.forgotPassword');
Route::post('forgot-password', 'AuthMemberController@forgotPassword')->name('post.home.forgotPassword');
