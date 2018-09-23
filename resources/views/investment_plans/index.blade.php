@extends('layouts.app')

@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Investment Plans </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th> name </th>
                                <th> minimum amount </th>
                                <th> maximum amount </th>
                                <th> status </th>
                                <th> actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $investmentPlans as $investmentPlan)
                                <tr>
                                    <td> {{ $investmentPlan->id }} </td>
                                    <td> {{ $investmentPlan->name }} </td>
                                    <td> {{ $investmentPlan->minimum_amount }} </td>
                                    <td> {{ $investmentPlan->maximum_amount }} </td>
                                    <td> {{ $investmentPlan->status }} </td>
                                    <td>
                                        {!! Html::link("investment_plans/edit/$investmentPlan->id",'Edit Investment Plan')  !!}
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
