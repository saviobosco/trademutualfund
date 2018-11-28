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
                    </div>
                </div>
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> User Investments </h4>
                    </div>
                    <div class="panel-body">
                        @if (isset($user->investments))
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> id</th>
                                    <th> amount investment </th>
                                    <th> return on investment </th>
                                    <th> global funds amount </th>
                                    <th> created </th>
                                    <th> release date </th>
                                    <th> status </th>
                                    <th> actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $user->investments as $investment)
                                    <tr>
                                        <td> {{ $investment->id }} </td>
                                        <td> {{ $investment->amount_invested }} </td>
                                        <td> {{ $investment->roi_amount }} </td>
                                        <td> {{ $investment->global_funds_amount }} </td>
                                        <td> {{ $investment->created_at }} </td>
                                        <td> {{ $investment->release_date }} </td>
                                        <td> {{ $investment->status }} </td>
                                        <td>
                                            {!! Html::link("/investments/view/$investment->id",'View Investment')  !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
