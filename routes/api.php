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

// Fixed Expense
Route::post('/fixedExpense', 'FixedExpenseController@save');
Route::get('/fixedExpense', 'FixedExpenseController@listAll');
Route::get('/fixedExpense/{id}', 'FixedExpenseController@getById');
Route::put('/fixedExpense/{id}', 'FixedExpenseController@update');
Route::delete('/fixedExpense/{id}', 'FixedExpenseController@delete');

// Variable Revenue
Route::post('/variableRevenue', 'VariableRevenueController@save');
Route::get('/variableRevenue', 'VariableRevenueController@listAll');
Route::get('/variableRevenue/{id}', 'VariableRevenueController@getById');
Route::put('/variableRevenue/{id}', 'VariableRevenueController@update');
Route::delete('/variableRevenue/{id}', 'VariableRevenueController@delete');

// Variable Expense
Route::post('/variableExpense', 'VariableExpenseController@save');
Route::get('/variableExpense', 'VariableExpenseController@listAll');
Route::get('/variableExpense/{id}', 'VariableExpenseController@getById');
Route::put('/variableExpense/{id}', 'VariableExpenseController@update');
Route::delete('/variableExpense/{id}', 'VariableExpenseController@delete');