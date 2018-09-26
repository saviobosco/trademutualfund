<?php

namespace App\Http\Controllers;

use App\GlobalFund;
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
        $loggedInUser = auth()->user();
        $transactions = UsersRepository::getUserActiveTransactions($loggedInUser->id);
        $investments = UsersRepository::getUserActiveInvestments($loggedInUser->id);
        $supportTickets = UsersRepository::getUserSupportTickets($loggedInUser->id);
        $cashAbleInvestments = UsersRepository::getUserCashAbleInvestments($loggedInUser->id);
        $referralsCount = UsersRepository::getUserReferralCount($loggedInUser->id);
        $globalFunds = Cache::remember('globalFundsTotal', (new Carbon())->addMinutes(10), function () {
            return GlobalFund::query()->pluck('amount')->sum();
        });
        $referralBonus = UsersRepository::getUserReferralBonus($loggedInUser->id);
        return view('home')->with(compact('transactions','investments','globalFunds','referralBonus','supportTickets','cashAbleInvestments', 'referralsCount'));
    }
}
