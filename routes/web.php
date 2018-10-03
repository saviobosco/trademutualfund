<?php

use App\Repository\StatisticsRepository;
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
    $totalUsers = StatisticsRepository::getTotalOfUsers();
    $totalPayout = StatisticsRepository::getTotalOfPayOuts();
    $totalTransactions = StatisticsRepository::getTotalOfTransactions();
    $testimonies = \App\Testimony::query()->with(['user:id,name'])->where('published',1)->latest('default')->get()->toArray();
    return view('welcome')->with(compact('testimonies','totalUsers','totalPayout','totalTransactions'));
});

Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    // Investment Routes
    Route::get('/user_investments/create','UserInvestmentsController@create')->name('new_investment');
    Route::post('/user_investments/create', 'UserInvestmentsController@store');
    Route::get('/user_investments/index', 'UserInvestmentsController@index');
    Route::post('/user_investments/cancel/{investment}', 'UserInvestmentsController@cancel');
    Route::post('/user_investments/cash_out/{investment}', 'UserInvestmentsController@cashOut');
    Route::post('/user_investments/addTestimony/{investment}', 'UserInvestmentsController@addTestimony');

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
    Route::put('/profile/edit', 'ProfileController@update');
    Route::get('/profile/edit', 'ProfileController@edit');
    Route::put('/profile/update_settings', 'UserSettingsController@update');
    Route::get('/profile/update_settings', 'UserSettingsController@edit');
    Route::put('/profile/change_password', 'ChangePasswordController@update');
    Route::get('/profile/change_password', 'ChangePasswordController@edit');
    Route::put('/profile/update_payment_info', 'PaymentDetailController@update');
    Route::get('/profile/update_payment_info', 'PaymentDetailController@edit');

    Route::post('/profile/add_testimony', 'ProfileController@addTestimony');

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
    Route::post('/transactions/reset_timer/{transaction}', 'TransactionsController@resetTimer');
    Route::post('/transactions/resolve_issue/{transaction}', 'TransactionsController@resolveIssue');

    //Global Funds
    Route::get('/global_funds/index','GlobalFundsController@index');
    Route::get('/global_funds/cash_out','GlobalFundsController@cashOut');
    Route::post('/global_funds/cash_out','GlobalFundsController@processCashOut');
    Route::get('/global_funds/activities','GlobalFundsController@cashOut');

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

    Route::get('/banks/index', 'BanksController@index');
    Route::post('/banks/create', 'BanksController@store');
    Route::get('/banks/create', 'BanksController@create');
    Route::put('/banks/edit/{bank}', 'BanksController@update');
    Route::get('/banks/edit/{bank}', 'BanksController@edit');

    Route::get('/settings/update', 'SettingsController@edit');
    Route::post('/settings/update', 'SettingsController@update');

    Route::get('/testimonies/index', 'TestimoniesController@index');
    Route::get('/testimonies/create', 'TestimoniesController@create');
    Route::post('/testimonies/create', 'TestimoniesController@store');
    Route::put('/testimonies/edit/{testimony}', 'TestimoniesController@update');
    Route::get('/testimonies/edit/{testimony}', 'TestimoniesController@edit');
    Route::delete('/testimonies/delete/{testimony}', 'TestimoniesController@destroy');
});

