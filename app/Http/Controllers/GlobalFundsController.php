<?php

namespace App\Http\Controllers;

use App\GlobalFund;
use Illuminate\Http\Request;

class GlobalFundsController extends Controller
{

    public function index()
    {
        $globalFunds = GlobalFund::all();
        return view('global_funds.index')->with(compact('globalFunds'));
    }
}
