<?php

namespace App\Http\Controllers;

use App\Repository\UsersRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = UsersRepository::getUserActiveTransactions(auth()->user()->id);
        return view('home')->with(compact('transactions'));
    }
}
