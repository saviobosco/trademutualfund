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
            Session::flash('message', 'Investment rule was successfully created!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GetPayment  $getPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(GetPayment $getPayment)
    {
        //
    }
}
