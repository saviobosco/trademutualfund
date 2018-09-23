@extends('layouts.app')

@section('title', 'Provide Helps')

@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Provide Helps </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th>user </th>
                                <th> investment Id </th>
                                <th> amount </th>
                                <th> completed at </th>
                                <th> status </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $makePayments as $makePayment)
                                <tr>
                                    <td> {{ $makePayment->id }} </td>
                                    <td> {{ $makePayment->user->name }} </td>
                                    <td> {{ $makePayment->investment_id }} </td>
                                    <td> {{ $makePayment->initial_amount }} </td>
                                    <td> {{ $makePayment->completed_at }} </td>
                                    <td> {{ $makePayment->status }} </td>
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
