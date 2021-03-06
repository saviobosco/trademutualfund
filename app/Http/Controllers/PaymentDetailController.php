<?php

namespace App\Http\Controllers;

use App\Bank;
use App\UserPaymentDetail;
use Illuminate\Http\Request;

class PaymentDetailController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $paymentDetail = auth()->user()->user_payment_details;
        $banks = Bank::query()->pluck('name', 'id')->toArray();
        return view('payment_detail.edit')->with(compact('paymentDetail', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        auth()->user()->user_payment_details()->update($request->except(['_token','_method']));
        flash('Your details has been updated')->success();
        return back();
    }
}
