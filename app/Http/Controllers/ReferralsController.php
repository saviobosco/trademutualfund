<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferralsController extends Controller
{
    public function index()
    {
        $referrals = auth()->user()->usersReferred();
        return view('referrals.index')->with(compact('referrals'));
    }
}
