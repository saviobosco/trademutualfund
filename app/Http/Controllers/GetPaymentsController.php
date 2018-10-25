<?php

namespace App\Http\Controllers;

use App\GetPayment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GetPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getPayments = GetPayment::query()->with(['user'])->get();
        return view('get_payments.index')->with(compact('getPayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::query()->get()->pluck('name', 'id');
        return view('get_payments.create')->with(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'user_id' => 'required',
            'amount' => 'required',
        ]);
        $getPayment = GetPayment::create([
            'user_id' => $validatedData['user_id'],
            'amount' => $validatedData['amount'],
            'initial_amount' => $validatedData['amount']
        ]);
        if ($getPayment) {
            flash('Investment rule was successfully created!')->success();
            return redirect('/get_payments/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GetPayment  $getPayment
     * @return \Illuminate\Http\Response
     */
    public function show(GetPayment $getPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GetPayment  $getPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(GetPayment $getPayment)
    {
        $users = User::query()->get()->pluck('name', 'id');
        return view('get_payments.edit')->with(compact('getPayment','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GetPayment  $getPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GetPayment $getPayment)
    {
        $validatedData = $this->validate($request, [
            'user_id' => 'required',
            'amount' => 'required',
        ]);
        $getPayment->update([
            'user_id' => $validatedData['user_id'],
            'amount' => $validatedData['amount'],
            'initial_amount' => $validatedData['amount']
        ]);

        if ($getPayment) {
            flash('Investment rule was successfully updated!')->success();
            return redirect('/get_payments/index');
        }
    }

    public function showCancel(GetPayment $getPayment)
    {
        return view('get_payments.show_cancel')->with(compact('getPayment'));
    }

    public function cancel(GetPayment $getPayment)
    {
        if ($getPayment->cancel()) {
            flash("#$getPayment->id was successfully cancelled!")->success();
        } else {
            flash("#$getPayment->id could not be cancelled!")->error();
        }
        return redirect('/get_payments/index');
    }

    public function delete(GetPayment $getPayment)
    {
        return view('get_payments.delete')->with(compact('getPayment'));
    }

    public function destroy(GetPayment $getPayment)
    {
        $getPayment->delete();
        return redirect('/get_payments/index');
    }
}
