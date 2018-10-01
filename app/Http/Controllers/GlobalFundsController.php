<?php

namespace App\Http\Controllers;

use App\GetPayment;
use App\GlobalFund;
use App\GlobalFundActivity;
use Illuminate\Http\Request;
use App\User;
class GlobalFundsController extends Controller
{

    public function index()
    {
        $globalFunds = GlobalFund::all();
        return view('global_funds.index')->with(compact('globalFunds'));
    }

    public function cashOut()
    {
        $global_funds = setting('global_funds');
        $users = User::query()->get()->pluck('name', 'id');
        return view('global_funds.cash_out')->with(compact('global_funds','users'));
    }

    public function processCashOut(Request $request)
    {
        $validatedData = $this->validate($request, [
            'user_id' => 'required',
            'amount' => 'required',
        ]);
        $global_funds = setting('global_funds');
        if ($validatedData['amount'] > $global_funds) {
            flash('Amount cannot be greater than global funds')->error();
            return back();
        }
        $global_funds -= $validatedData['amount'];
        $getPayment = GetPayment::create([
            'user_id' => $validatedData['user_id'],
            'amount' => $validatedData['amount'],
            'initial_amount' => $validatedData['amount']
        ]);
        GlobalFundActivity::create([
            'user_id' => $validatedData['user_id'],
            'amount' => $validatedData['amount'],
        ]);
        setting(['global_funds' => $global_funds]);
        setting()->save();
        flash('Global fund cash was successful')->success();
        return back();
    }
}
