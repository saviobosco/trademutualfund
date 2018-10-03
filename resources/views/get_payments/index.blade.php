@extends('layouts.app')

@section('title', 'Get Helps')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">

                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        {!! Html::link("get_payments/create",'New Get Help',['class' => 'pull-right'])  !!}
                        <h4 class="panel-title">  Get Helps </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive-sm">
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
                            @foreach( $getPayments as $getPayment)
                                <tr>
                                    <td> {{ $getPayment->id }} </td>
                                    <td> {{ $getPayment->user->name }} </td>
                                    <td> {{ $getPayment->investment_id }} </td>
                                    <td> {{ $getPayment->initial_amount }} </td>
                                    <td> {{ $getPayment->completed_at }} </td>
                                    <td> {{ $getPayment->status }} </td>
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
