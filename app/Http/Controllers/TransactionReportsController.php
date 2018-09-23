<?php

namespace App\Http\Controllers;

use App\TransactionReport;
use Illuminate\Http\Request;

class TransactionReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = TransactionReport::query()->orderBy('status')->get();
        return view('transaction_reports.index')->with(compact('reports'));
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
     * @param  \App\TransactionReport  $transactionReport
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionReport $transactionReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransactionReport  $transactionReport
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionReport $transactionReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransactionReport  $transactionReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionReport $transactionReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransactionReport  $transactionReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionReport $transactionReport)
    {
        //
    }
}
