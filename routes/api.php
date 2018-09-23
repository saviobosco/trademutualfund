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

Route::get('/investment_plans', 'InvestmentPlansController@index');

Route::get('/investment_plans/{investmentPlan}/investment_rules', 'InvestmentPlansController@getRules');

// Transactions
Route::get('/transactions/active', 'TransactionsController@active');
Route::post('/transactions/upload_proof/{transaction}', 'TransactionsController@uploadProofOfPayment');
Route::post('/transactions/remove_proof/{transaction}', 'TransactionsController@removeProofOfPayment');
Route::post('/transactions/report/{transaction}', 'TransactionsController@report');