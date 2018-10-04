<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReferralPyramid;

class ReferralsController extends Controller
{
    public function index()
    {
        $referrals = ReferralPyramid::whereDescendantOf(auth()->user()->id)->get()->toTree();
        return view('referrals.index')->with(compact('referrals'));
    }
}
