<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvestmentPlansCollection;
use App\InvestmentPlan;
use App\InvestmentRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InvestmentPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return new InvestmentPlansCollection(InvestmentPlan::all());
        }
        return view('investment_plans/index')->with('investmentPlans', InvestmentPlan::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $investmentRules = InvestmentRule::query()->get()->pluck('duration', 'id')->toArray();
        return view('investment_plans.create')->with(compact('investmentRules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'minimum_amount' => 'required',
            'maximum_amount' => 'required',
        ]);
        $investmentPlan = InvestmentPlan::create($validatedData);
        if ($investmentPlan) {
            $attachedRules = $request->only(['attach_rules']);
            foreach( $attachedRules as $ruleId) {
                $investmentPlan->investment_rules()->attach($ruleId);
            }
            Session::flash('message', 'Investment rule was successfully created!');
            return back();
        }
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
        //dd($investmentPlan);
        return view('investment_plans.edit')->with(compact('investmentPlan'));
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

    public function getRules(InvestmentPlan $investmentPlan) {
        return response()->json([
            'data' => $investmentPlan->getInvestmentRules()
        ]);
    }
}
