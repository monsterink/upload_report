<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/uploads', 'App\Http\Controllers\UploadReportController@index');
Route::get('/uploads', 'App\Http\Controllers\UploadReportController@index')->name('uploads')->middleware('auth');
//Route::get('/uploads/{id}', 'App\Http\Controllers\UploadReportController@preview');

Route::get('/delete/{upload_id}', 'App\Http\Controllers\UploadReportController@delete');

Route::get('/uploads/create', 'App\Http\Controllers\UploadReportController@create')->name('create');
Route::post('/uploads', 'App\Http\Controllers\UploadReportController@store');

Route::get('/uploads/edit/{upload_id}', 'App\Http\Controllers\UploadReportController@show');
Route::post('/uploads/edit/{upload_id}', 'App\Http\Controllers\UploadReportController@edit');

Route::post('/patients/getPatients','App\Http\Controllers\UploadReportController@findAn');

Route::get('/uploads/role/', 'App\Http\Controllers\UploadReportController@role')->name('role');
Route::post('/uploads/role/{user_id}', 'App\Http\Controllers\UploadReportController@update');
//Route::get('/upload_list', 'App\Http\Controllers\UploadReportController@homeDoctor');

Route::get('/print/{upload_id}', 'App\Http\Controllers\UploadReportController@print');
Route::get('/preview/{upload_id}', 'App\Http\Controllers\UploadReportController@preview');
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
