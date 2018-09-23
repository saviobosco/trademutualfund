@extends('layouts.app')

@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Users </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th> name </th>
                                <th> email </th>
                                <th> email verified at </th>
                                <th> phone </th>
                                <th> actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $users as $user)
                                <tr>
                                    <td> {{ $user->id }} </td>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> {{ $user->email_verified_at }} </td>
                                    <td> {{ $user->phone_number }} </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ url('/users/view/'.$user->id) }}"> View User </a>
                                        <a class="btn btn-primary btn-sm" href="{{ url('/users/edit/'.$user->id) }}"> Edit User </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
