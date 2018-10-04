<?php

namespace App\Http\Controllers;

use App\Investment;
use App\InvestmentRule;
use App\MakePayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserInvestmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investments = auth()->user()->getInvestments();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $investments
            ]);
        }
        return view('user_investments.index')->with(compact('investments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user_investments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the request
        $validatedData = $request->validate([
            'plan' => 'required',
            'rule' => 'required',
            'amount' => 'required',
        ]);
        $makePayment = MakePayment::create([
            'user_id' => auth()->user()->id,
            'amount' => $validatedData['amount'],
            'initial_amount' => $validatedData['amount'],
        ]);
        if ($makePayment) {
            $investmentRule = InvestmentRule::find($validatedData['rule']);
            $releaseDate = new Carbon('+ '.$investmentRule->duration);
            $investment = Investment::create([
                'user_id' => auth()->user()->id,
                'make_payment_id' => $makePayment->id,
                'amount_invested' => $validatedData['amount'],
                'roi_amount' => $validatedData['amount'] + ($validatedData['amount'] * ($investmentRule->investment_percentage / 100)),
                'global_funds_amount' => $validatedData['amount'] * ($investmentRule->global_percentage / 100),
                'investment_plan_id' => $validatedData['plan'],
                'release_date' => $releaseDate
            ]);
            // save last plan to user setting
            auth()->user()->user_setting()->update(['last_investment_plan' => $validatedData['plan']]);
            // update make payment
            $makePayment->update(['investment_id' => $investment->id]);
            if ($request->wantsJson()) {
                return response()->json([
                    'data' => $investment
                ]);
            }
            flash('You have successfully started a new investment!')->success();
            return back();
        }
    }

    public function addTestimony(Request $request, Investment $investment)
    {
        if ($investment->addTestimony($request->input('testimony'))) {
            return response()->json([
                'data' => 'OK'
            ]);
        } else {
            return response()->json([
                'data' => 'Error'
            ]);
        }
    }

    public function cancel(Investment $investment)
    {
        if (auth()->user()->id !== (int)$investment->user_id) { // type hinted the user_id to an Integer
            return response()->json([
                'data' => 'Error'
            ],401);
        }
        if ($investment->cancel()) {
            return response()->json(['data' => 'OK']);
        } else {
            return response()->json(['data' => 'Error'],422);
        }
        // belongs to user
        // is active
        // cancel
    }

    public function cashOut(Investment $investment)
    {
        if (auth()->user()->id !== (int)$investment->user_id) {
            return response()->json([
                'data' => 'Error'
            ],401);
        }
        if (! $investment->isCashAble()) {
            return response()->json(['data' => 'Error'],422);
        }
        if ($investment->cashOutInvestment()) {
            return response()->json(['data' => 'OK']);
        }
    }
}
