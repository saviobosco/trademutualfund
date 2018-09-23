@extends('layouts.app')

@section('title', 'Global Funds')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">

                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title">  Global Funds </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th> investment Id </th>
                                <th> amount </th>
                                <th> user merged to </th>
                                <th> status </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $globalFunds as $globalFund)
                                <tr>
                                    <td> {{ $globalFund->id }} </td>
                                    <td> {{ $globalFund->investment_id }} </td>
                                    <td> {{ $globalFund->amount }} </td>
                                    <td> {{ $globalFund->user_id }} </td>
                                    <td> {{ $globalFund->status }} </td>
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
