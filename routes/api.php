<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('insert','ConverterController@toArrays');
Route::get('get-data','ConverterController@getData');
Route::get('get-data/{number}','ConverterController@getData')->name('get-data');
Route::get('data/date','ConverterController@filterByDates')->name('data/date');
