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

Route::get('/upload', function () {
    return view('Upload');
});
Route::post('/upload', 'App\Http\Controllers\UploadReportController@store');
