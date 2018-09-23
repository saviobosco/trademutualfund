<?php

namespace App\Http\Controllers;

use App\InvestmentRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InvestmentRulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investmentRules = InvestmentRule::all();
        return view('investment_rules.index')->with(compact('investmentRules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('investment_rules.create');
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
            'duration' => 'required',
            'investment_percentage' => 'required',
            'global_percentage' => 'required'
        ]);

        if (InvestmentRule::create($validatedData)) {
            Session::flash('message', 'Investment rule was successfully created!');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvestmentRule  $investmentRule
     * @return \Illuminate\Http\Response
     */
    public function show(InvestmentRule $investmentRule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvestmentRule  $investmentRule
     * @return \Illuminate\Http\Response
     */
    public function edit(InvestmentRule $investmentRule)
    {
        return view('investment_rules.edit')->with(compact('investmentRule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvestmentRule  $investmentRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvestmentRule $investmentRule)
    {
        $validatedData = $request->validate([
            'duration' => 'required',
            'investment_percentage' => 'required',
            'global_percentage' => 'required'
        ]);

        if ($investmentRule->update($validatedData)) {
            Session::flash('message', 'Investment rule was successfully updated!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvestmentRule  $investmentRule
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvestmentRule $investmentRule)
    {
        //
    }
}
