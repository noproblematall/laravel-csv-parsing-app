<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index')->name('admin.home');

Route::get('dashboard', 'IndexController@index')->name('admin.dashboard');
Route::get('usermanagement', 'UserController@index')->name('admin.user');
Route::get('get_user_list', 'UserController@getUserList')->name('admin.user_list');

Route::get('test', 'IndexController@test');