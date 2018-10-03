@extends('layouts.app')

@section('title', 'Transaction Reports')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Transaction Reports </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th> transaction </th>
                                <th> type </th>
                                <th> status </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $reports as $report)
                                <tr>
                                    <td> {{ $report->id }} </td>
                                    <td> {!! Html::link("transactions/view/$report->transaction_id",'View Transaction')  !!} </td>
                                    <td> {{ $report->type }} </td>
                                    <td> {{ $report->status }} </td>
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
