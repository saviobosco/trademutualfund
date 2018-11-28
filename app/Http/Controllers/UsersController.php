<?php

namespace App\Http\Controllers;

use App\Countries;
use App\User;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')->with('users',User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $countries = Countries::query()->select(['id', 'full_name'])->pluck('full_name', 'id')->toArray();
        $user = User::query()->with(['investments'])->where('id', $id)->first();
        return view('users.view')->with(compact('user','countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $userRoles = $user->roles()->pluck('id');
        $countries = Countries::query()->select(['id', 'full_name'])->pluck('full_name', 'id')->toArray();
        return view('users.edit')->with(compact('user','countries','roles','userRoles'));
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
        $user->fill($request->except(['_token','_method','roles','email_verified_at','phone_verified_at']));
        if ((int) $request->input('email_verified_at') === 1) {
            $user->forceFill(['email_verified_at' => new Carbon()]);
        } else {
            $user->forceFill(['email_verified_at' => null]);
        }
        if ((int) $request->input('phone_verified_at') === 1) {
            $user->forceFill(['phone_verified_at' => new Carbon()]);
        } else {
            $user->forceFill(['phone_verified_at' => null]);
        }
        if ((int) $request->input('blocked_at') === 1) {
            $user->forceFill(['blocked_at' => new Carbon()]);
        } else {
            $user->forceFill(['blocked_at' => null]);
        }
        $user->update();
        $user->syncRoles($request->input('roles'));
        flash('User record has been updated')->success();
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
}
