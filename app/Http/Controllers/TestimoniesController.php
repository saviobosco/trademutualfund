<?php

namespace App\Http\Controllers;

use App\Testimony;
use App\User;
use Illuminate\Http\Request;

class TestimoniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonies = Testimony::query()->with(['user:id,name'])->latest('created_at')->paginate(20);
        return view('testimonies.index')->with(compact('testimonies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::query()->get()->pluck('name', 'id');
        return view('testimonies.create')->with(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'testimony' => 'required'
        ]);
        Testimony::create($request->except(['_token']));
        flash('Testimony was successfully created created!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function show(Testimony $testimony)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimony $testimony)
    {
        $users = User::query()->get()->pluck('name', 'id');
        return view('testimonies.edit')->with(compact('users','testimony'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimony $testimony)
    {
        $testimony->update($request->except(['_method','_token']));
        flash('Testimony updated')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimony $testimony)
    {
        $testimony->delete();
        flash('testimony has been deleted');
        return back();
    }
}
