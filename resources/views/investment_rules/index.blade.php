@extends('layouts.app')

@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Investment Plans </h4>
                         {!! Html::link("investment_rules/create",'New Rule',['class' => 'pull-right'])  !!}
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th> duration </th>
                                <th> investment percentage </th>
                                <th> global percentage </th>
                                <th> status </th>
                                <th> actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $investmentRules as $investmentRule)
                                <tr>
                                    <td> {{ $investmentRule->id }} </td>
                                    <td> {{ $investmentRule->duration }} </td>
                                    <td> {{ $investmentRule->investment_percentage }}% </td>
                                    <td> {{ $investmentRule->global_percentage }}% </td>
                                    <td> {{ $investmentRule->status }} </td>
                                    <td>
                                        {!! Html::link("investment_rules/edit/$investmentRule->id",'Edit Rule')  !!}
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
