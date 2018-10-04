@extends('layouts.app')

@section('title', 'View User')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> View User </h4>
                    </div>
                    <div class="panel-body">
                        <p> Name : {{ $user->name }} </p>
                        <p> Email : {{ $user->email }} </p>
                        <p> Phone Number : {{ $user->phone_number }} </p>
                        <p> Country : {{ @$countries[$user->country_id] }} </p>
                        load user investments
                        load user activities
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
