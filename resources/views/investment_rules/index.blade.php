@extends('layouts.app')

@section('title', 'Investment Rules')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        {!! Html::link("investment_rules/create",'New Rule',['class' => 'pull-right'])  !!}
                        <h4 class="panel-title"> Investment Rules </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th> duration </th>
                                <th> investment percentage </th>
                                <th> global percentage </th>
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
                                    <td>
                                        {!! Html::link("investment_rules/edit/$investmentRule->id",'Edit Rule', ['class' => 'btn btn-primary btn-sm'])  !!}
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
