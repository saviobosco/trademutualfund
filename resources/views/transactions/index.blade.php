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
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th> make payment user </th>
                                <th> get payment user </th>
                                <th> amount </th>
                                <th> created at </th>
                                <th> Elapse Time </th>
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
                                    <td> &#x20A6;{{ format_decimal($transaction->amount) }} </td>
                                    <td> {{ $transaction->created_at->format('l jS, F Y h:i:s A') }} </td>
                                    <td> {{ $transaction->time_elapse_after->format('l jS, F Y h:i:s A') }} </td>
                                    <td>
                                        @switch($transaction->status)
                                            @case(1)
                                                <span class="label label-primary"> active </span>
                                                @break
                                            @case(2)
                                                <span class="label label-success"> completed </span>
                                                @break
                                            @case(-1)
                                                <span class="label label-danger"> cancelled </span>
                                                @break
                                            @default
                                                <span class="label label-danger"> unknown </span>
                                        @endswitch
                                    </td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ url('/transactions/view/'.$transaction->id) }}"> View Transaction </a> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
