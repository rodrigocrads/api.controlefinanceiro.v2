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

// Category
Route::post('/category', 'CategoryController@save');
Route::put('/category/{id}', 'CategoryController@update');
Route::delete('/category/{id}', 'CategoryController@delete');
Route::get('/category', 'CategoryController@listAll');
Route::get('/category/{id}', 'CategoryController@getById');

// Fixed Revenue
Route::post('/fixedRevenue', 'FixedRevenueController@save');
Route::get('/fixedRevenue', 'FixedRevenueController@listAll');
Route::get('/fixedRevenue/{id}', 'FixedRevenueController@getById');
Route::put('/fixedRevenue/{id}', 'FixedRevenueController@update');
Route::delete('/fixedRevenue/{id}', 'FixedRevenueController@delete');