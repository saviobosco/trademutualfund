<?php

namespace App\Http\Controllers;

use App\MakePayment;
use Illuminate\Http\Request;

class MakePaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makePayments = MakePayment::query()->with(['user'])->get();
        return view('make_payments.index')->with(compact('makePayments'));
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
     * @param  \App\MakePayment  $makePayment
     * @return \Illuminate\Http\Response
     */
    public function show(MakePayment $makePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MakePayment  $makePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(MakePayment $makePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MakePayment  $makePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MakePayment $makePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MakePayment  $makePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(MakePayment $makePayment)
    {
        //
    }
}
