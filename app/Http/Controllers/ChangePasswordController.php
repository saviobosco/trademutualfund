<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\User;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view('change_password.edit');
    }

    public function update(Request $request)
    {
        $request_data = $request->validate([
            'current_password' => 'bail|required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $current_password = Auth::User()->password;
        if(! Hash::check($request_data['current_password'], $current_password)) {
            flash('Please enter correct current password!')->error();
            return back();
        }
        $user_id = Auth::User()->id;
        $obj_user = User::find($user_id);
        $obj_user->password = Hash::make($request_data['password']);
        $obj_user->save();
        Auth::login($obj_user);
        flash('password was successfully updated!')->success();
        return back();
    }
}
