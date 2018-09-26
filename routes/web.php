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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    // Investment Routes
    Route::get('/user_investments/create','UserInvestmentsController@create')->name('new_investment');
    Route::post('/user_investments/create', 'UserInvestmentsController@store');
    Route::get('/user_investments/index', 'UserInvestmentsController@index');
    Route::put('/user_investments/cancel/{investment}', 'UserInvestmentsController@cancel');

    // User Transactions
    Route::get('/transactions/active', 'UserTransactionsController@active');
    Route::post('/transactions/upload_proof/{transaction}', 'TransactionsController@uploadProofOfPayment');
    Route::post('/transactions/remove_proof/{transaction}', 'TransactionsController@removeProofOfPayment');
    Route::post('/transactions/report/{transaction}', 'TransactionsController@report');
    Route::post('/transactions/confirm/{transaction}', 'TransactionsController@confirm');
    Route::post('/transactions/cancel/{transaction}', 'TransactionsController@cancel');

    Route::get('/user_transactions/index', 'UserTransactionsController@index');

    //MakePayment
    Route::get('/make_payments/index', 'MakePaymentsController@index');

    Route::get('/user_investment_plans', 'UserInvestmentPlansController@index');

    // Profile
    Route::get('/profile/view', 'ProfileController@show');
    Route::put('/profile/edit', 'UsersController@update');
    Route::get('/profile/edit', 'ProfileController@edit');
    Route::put('/profile/update_settings', 'UserSettingsController@update');
    Route::get('/profile/update_settings', 'UserSettingsController@edit');
    Route::put('/profile/change_password', 'ChangePasswordController@update');
    Route::get('/profile/change_password', 'ChangePasswordController@edit');
    Route::put('/profile/update_payment_info', 'PaymentDetailController@update');
    Route::get('/profile/update_payment_info', 'PaymentDetailController@edit');

    Route::get('/user_referral/index', 'ReferralsController@index');
});



Route::middleware(['verified','role:admin'])->group(function() {
    Route::get('/users/index', 'UsersController@index');
    Route::get('/users/view/{user}', 'UsersController@show');
    Route::put('/users/edit/{user}', 'UsersController@update');
    Route::get('/users/edit/{user}', 'UsersController@edit');

    Route::get('/transaction_reports/index', 'TransactionReportsController@index');

    // GetPayment
    Route::get('/get_payments/index', 'GetPaymentsController@index');
    Route::get('/get_payments/create', 'GetPaymentsController@create');
    Route::post('/get_payments/create', 'GetPaymentsController@store');

    Route::get('/transactions/index', 'TransactionsController@index');
    Route::get('/transactions/view/{transaction}', 'TransactionsController@show');

    //Global Funds
    Route::get('/global_funds/index','GlobalFundsController@index');

    Route::get('/investment_rules/index', 'InvestmentRulesController@index');
    Route::post('/investment_rules/create', 'InvestmentRulesController@store');
    Route::get('/investment_rules/create', 'InvestmentRulesController@create');
    Route::put('/investment_rules/edit/{investmentRule}', 'InvestmentRulesController@update');
    Route::get('/investment_rules/edit/{investmentRule}', 'InvestmentRulesController@edit');

    Route::get('/investment_plans/create', 'InvestmentPlansController@create')->name('new_investment_plan');
    Route::post('/investment_plans/create', 'InvestmentPlansController@store');
    Route::get('/investment_plans/index', 'InvestmentPlansController@index');
    Route::put('/investment_plans/edit/{investmentPlan}', 'InvestmentPlansController@update');
    Route::get('/investment_plans/edit/{investmentPlan}', 'InvestmentPlansController@edit');
});

