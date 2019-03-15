<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');

Route::get('working_area', 'HomeController@upload')->name('working_area');
Route::get('main_process', 'HomeController@process')->name('main_process')->middleware('fileUploaded');

Auth::routes(['verify' => true]);

Route::post('file_upload', 'HomeController@fileUploadPost')->name('fileUploadPost');
Route::get('get_file_info', 'HomeController@get_file_info')->name('get_file_info');
Route::post('set_header', 'HomeController@setHeader')->name('set_header');

Route::post('upload', 'FileController@fileUploadPost')->name('fileUploadPost');

Route::get('process_cancel', 'HomeController@processCancel')->name('process_cancel');