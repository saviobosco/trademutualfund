<?php

namespace App\Http\Controllers;

use App\InvestmentPlan;
use Illuminate\Http\Request;
use App\Http\Resources\InvestmentPlansCollection;

class UserInvestmentPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get user settings
        $investmentPlans = null;
        $userSettings = auth()->user()->user_setting;
        if (! is_null($userSettings->last_investment_plan)) {
            $investmentPlans = InvestmentPlan::query()
                ->where('id', '>=', $userSettings->last_investment_plan)
                ->get();
        } else {
            $investmentPlans = InvestmentPlan::all();
        }
        return new InvestmentPlansCollection($investmentPlans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvestmentPlan  $investmentPlan
     * @return \Illuminate\Http\Response
     */
    public function show(InvestmentPlan $investmentPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvestmentPlan  $investmentPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(InvestmentPlan $investmentPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvestmentPlan  $investmentPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvestmentPlan $investmentPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvestmentPlan  $investmentPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvestmentPlan $investmentPlan)
    {
        //
    }
}
