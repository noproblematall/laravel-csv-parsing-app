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
Route::post('make_active', 'UserController@makeActive')->name('admin.make_active');
Route::post('make_inactive', 'UserController@makeInactive')->name('admin.make_inactive');
Route::post('user_delete', 'UserController@delete')->name('admin.user_delete');

Route::get('package', 'PackageController@index')->name('admin.package');

Route::get('dataset', 'DatasetController@index')->name('admin.dataset');

Route::get('payment', 'PaymentController@index')->name('admin.payment');

Route::get('contact', 'ContactController@index')->name('admin.contact');

Route::get('settings', 'SettingController@index')->name('admin.setting');



Route::get('test', 'IndexController@test');