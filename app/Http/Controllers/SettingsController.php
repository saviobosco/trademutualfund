<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        return view('settings.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required'
        ]);
        $requestData = $request->except(['_token']);
        foreach( $requestData as $key => $value) {
            setting([$key => $value]);
        }
        setting()->save();
        flash('Settings has been updated!', 'success');
        return back();
    }
}
