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
Route::group(['middleware' => ['auth:api']], function() {
    Route::patch('/user/{id}', 'Auth\UserApiController@update');
    Route::get('/user', 'Auth\UserApiController@me');
    Route::post('/logout', 'Auth\UserApiController@logout');
    Route::patch('/changePassword', 'Auth\UserApiController@changePassword');

    // Category
    Route::post('/category', 'CategoryController@save');
    Route::put('/category/{id}', 'CategoryController@update');
    Route::delete('/category/{id}', 'CategoryController@delete');
    Route::get('/category', 'CategoryController@listAll');
    Route::get('/category/{id}', 'CategoryController@getById');

    // Financial Transaction
    Route::post('/financialTransaction', 'FinancialTransactionController@save');
    Route::get('/financialTransaction', 'FinancialTransactionController@listAll');
    Route::get('/financialTransaction/{id}', 'FinancialTransactionController@getById');
    Route::put('/financialTransaction/{id}', 'FinancialTransactionController@update');
    Route::delete('/financialTransaction/{id}', 'FinancialTransactionController@delete');

    // Report
    Route::get('/report/currentMonthTotals', 'ReportController@getCurrentMonthTotals');
    Route::get('/report/currentYearTotals', 'ReportController@getCurrentYearTotals');
    Route::get('/report/currentYearExpensesTotalsByCategories', 'ReportController@getCurrentYearExpensesTotalsByCategories');
});