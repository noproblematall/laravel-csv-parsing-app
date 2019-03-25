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

Route::get('/', 'IndexController@index')->name('home');

Route::get('working_area', 'HomeController@upload')->name('working_area');
Route::get('main_process', 'HomeController@process')->name('main_process')->middleware('fileUploaded');
Route::get('contact', 'HomeController@contact')->name('contact');
Route::get('packages', 'HomeController@package')->name('package');

Auth::routes(['verify' => true]);

Route::post('file_upload', 'HomeController@fileUploadPost')->name('fileUploadPost');
Route::get('get_file_info', 'HomeController@get_file_info')->name('get_file_info');
Route::post('set_header', 'HomeController@setHeader')->name('set_header');
Route::post('processor', 'HomeController@processor')->name('processor');
Route::post('upload', 'FileController@fileUploadPost')->name('fileUploadPost');
Route::get('process_cancel', 'HomeController@processCancel')->name('process_cancel');
Route::post('download', 'WorkingendController@download')->name('download');


Route::group(['prefix' => 'user'], function () {
    Route::any('dashboard', 'UserController@index')->name('user.dashboard');
    Route::any('personal_info', 'UserController@personal_info')->name('user.personal_info');
    Route::any('manage_membership', 'UserController@membership')->name('user.membership');
    Route::any('change_password', 'UserController@change_pwd')->name('user.change_pwd');
    Route::get('processing_list', 'UserController@getProcessingList')->name('user.get_processing_list');
    Route::get('completed_list', 'UserController@getCompletedList')->name('user.get_completed_list');
    Route::get('processing_list/mobile', 'UserController@getMobileProcessingList')->name('user.get_mobile_processing_list');
    Route::get('completed_list/mobile', 'UserController@getMobileCompletedList')->name('user.get_mobile_completed_list');
});




Route::get('test','WorkingendController@test2');
Route::get('info','HomeController@info');