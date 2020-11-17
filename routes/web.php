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

Route::get('/homeDoctor', 'App\Http\Controllers\UploadReportController@index');
Route::get('/homeDoctor/{upload_id}', 'App\Http\Controllers\UploadReportController@preview');

Route::get('/confirm/{upload_id}', 'App\Http\Controllers\UploadReportController@update');

Route::get('/delete/{upload_id}', 'App\Http\Controllers\UploadReportController@delete');

Route::get('/upload', function () {
    return view('Upload');
});
Route::post('/upload', 'App\Http\Controllers\UploadReportController@store');

Route::get('/homeStaff', 'App\Http\Controllers\UploadReportController@homeStaff');

Route::get('/print/{upload_id}', 'App\Http\Controllers\UploadReportController@print');