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
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('/user', 'Auth\UserApiController@update');
    Route::post('/logout', 'Auth\UserApiController@logout');
    Route::patch('/changePassword', 'Auth\UserApiController@changePassword');

    // Category
    Route::post('/category', 'CategoryController@save');
    Route::put('/category/{id}', 'CategoryController@update');
    Route::delete('/category/{id}', 'CategoryController@delete');
    Route::get('/category', 'CategoryController@listAll');
    Route::get('/category/{id}', 'CategoryController@getById');

    // Entry
    Route::post('/entry', 'EntryController@save');
    Route::get('/entry', 'EntryController@listAll');
    Route::get('/entry/{id}', 'EntryController@getById');
    Route::put('/entry/{id}', 'EntryController@update');
    Route::delete('/entry/{id}', 'EntryController@delete');

    // Report
    Route::get('/report/currentMonthTotals', 'ReportController@getCurrentMonthTotals');
    Route::get('/report/currentYearTotals', 'ReportController@getCurrentYearTotals');
    Route::get('/report/totalExpenseByCategoryAndByMonth', 'ReportController@getTotalExpenseByCategoryAndByMonth');
    Route::get('/report/totalsByMonth', 'ReportController@getTotalsByMonth');
    Route::get('/report/totalExpenseByCategory', 'ReportController@getTotalExpenseByCategory');
    Route::get('/report/totalRevenueByCategory', 'ReportController@getTotalRevenueByCategory');
});