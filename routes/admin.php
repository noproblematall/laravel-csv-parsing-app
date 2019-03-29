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
Route::get('package/add', 'PackageController@pre_add')->name('admin.preadd_package');
Route::post('package/add', 'PackageController@add')->name('admin.add_package');
Route::get('package/edit/{id}', 'PackageController@pre_edit')->name('admin.pre_pk_edit');
Route::post('package/edit', 'PackageController@edit')->name('admin.pk_edit');
Route::post('package/delete', 'PackageController@delete')->name('admin.delete_pacakge');
Route::post('package/make_active', 'PackageController@makeActive')->name('admin.pk_make_active');
Route::post('package/make_inactive', 'PackageController@makeInactive')->name('admin.pk_make_inactive');

Route::get('dataset', 'DatasetController@index')->name('admin.dataset');

Route::get('payment', 'PaymentController@index')->name('admin.payment');

Route::get('contact', 'ContactController@index')->name('admin.contact');

Route::get('settings', 'SettingController@index')->name('admin.setting');



Route::get('test', 'IndexController@test');