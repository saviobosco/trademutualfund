@extends('layouts.app')

@section('title', 'View Profile')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title"> View Profile </h4>
                    </div>
                    <div class="panel-body">
                        <p> Name : {{ $user->name }} </p>
                        <p> Email : {{ $user->email }} </p>
                        <p> Phone Number : {{ $user->phone_number }} </p>
                        <p> Country : {{ @$countries[$user->country_id] }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
