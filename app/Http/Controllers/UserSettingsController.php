<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserSettingsController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $userSettings = auth()->user()->user_setting;
        return view('user_settings.edit')->with(compact('userSettings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $userSettings = auth()->user()->user_setting;
        $update = $request->except(['_token','_method','last_investment_plan']);
        if (! isset($update['email_notification'])) {
            $update['email_notification'] = 0;
        }
        $userSettings->update($update);
        flash('settings was successfully updated');
        return back();
    }
}
