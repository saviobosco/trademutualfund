<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\ReferralPyramid;

class ReferralsController extends Controller
{
    public function index()
    {
        $referrals= null;
        try {
            $referrals = ReferralPyramid::whereDescendantOf(auth()->user()->id)->get()->toTree();
        } catch (ModelNotFoundException $exception) {
        }
        return view('referrals.index')->with(compact('referrals'));
    }
}
