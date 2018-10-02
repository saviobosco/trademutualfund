<?php

namespace App\Http\Controllers;

use App\Countries;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $countries = Countries::query()->select(['id', 'full_name'])->pluck('full_name', 'id')->toArray();
        $user = auth()->user();
        return view('profile.view')->with(compact('user','countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $countries = Countries::query()->select(['id', 'full_name'])->pluck('full_name', 'id')->toArray();
        $user = auth()->user();
        return view('users.edit')->with(compact('user','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        auth()->user()->update($request->except(['_token','_method']));
        Session::flash('message', 'Your details has been updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function addTestimony(Request $request)
    {
        if (auth()->user()->addTestimony($request->input('testimony'))) {
            return response()->json([
                'data' => 'OK'
            ]);
        } else {
            return response()->json([
                'data' => 'Error'
            ]);
        }
    }
}
