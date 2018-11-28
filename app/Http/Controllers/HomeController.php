<?php

namespace App\Http\Controllers;

use App\GlobalFund;
use App\Repository\StatisticsRepository;
use App\Repository\UsersRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $globalFunds = setting('global_funds_cumulative');
            $totalUsers = StatisticsRepository::getTotalOfUsers();
            $totalSupports = StatisticsRepository::getTotalActiveSupportTickets();
            $totalActiveMakePayments = StatisticsRepository::getTotalActiveMakePayments();
            $totalMergedMakePayments = StatisticsRepository::getTotalMergedMakePayments();
            $totalActiveGetPayments = StatisticsRepository::getTotalActiveGetPayments();
            $totalActiveInvestments = StatisticsRepository::getActiveRunningInvestments();
        }
        $loggedInUser = auth()->user();
        $transactions = UsersRepository::getUserActiveTransactions($loggedInUser->id);
        $investments = UsersRepository::getUserActiveInvestments($loggedInUser->id);
        $cashAbleInvestments = UsersRepository::getUserCashAbleInvestments($loggedInUser->id);
        $referralsCount = UsersRepository::getUserReferralCount($loggedInUser->id);
        $globalFundsCumulative = setting('global_funds_cumulative');

        $userPaymentDetails = auth()->user()->user_payment_details;

        $referralBonus = UsersRepository::getUserReferralBonus($loggedInUser->id);
        $completedInvestmentsCount = UsersRepository::getCompletedInvestmentWithNoTestimony($loggedInUser->id);
        if ($completedInvestmentsCount >= 1) {
            flash()->overlay("You have completed investments with no testimony. <br>
                click <a href='".url('/user_investments/index')."'> here </a> to add testimony", 'Missing Investment Testimony ');
        }
        return view('home')->with(compact('transactions',
            'totalUsers',
            'globalFunds',
            'totalSupports',
            'investments',
            'globalFunds',
            'referralBonus',
            'cashAbleInvestments',
            'referralsCount',
            'userPaymentDetails',
            'globalFundsCumulative',
            'totalActiveMakePayments',
            'totalActiveGetPayments',
            'totalActiveInvestments',
            'totalMergedMakePayments'
            ));
    }
}
