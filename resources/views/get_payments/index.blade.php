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
                                <th> actions </th>
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
                                    <td>
                                        <a href="{{ url('/get_payments/edit/'.$getPayment->id) }}"> edit </a> |
                                        <a href="{{ url('/get_payments/cancel/'.$getPayment->id) }}"> cancel </a> |
                                        <a class="text-danger" href="{{ url('/get_payments/delete/'.$getPayment->id) }}"> delete </a>
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
