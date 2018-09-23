@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Transactions  </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th> make payment user </th>
                                <th> get payment user </th>
                                <th> amount </th>
                                <th> status </th>
                                <th> actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $transactions as $transaction)
                                <tr>
                                    <td> {{ $transaction->id }} </td>
                                    <td> {{ $transaction->make_payment_user->name }} </td>
                                    <td> {{ $transaction->get_payment_user->name }} </td>
                                    <td> {{ $transaction->amount }} </td>
                                    <td> {{ $transaction->status }} </td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ url('/transactions/view/'.$transaction->id) }}"> View Transaction </a> </td>
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
