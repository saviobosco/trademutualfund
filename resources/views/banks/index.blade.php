@extends('layouts.app')

@section('title', 'Banks')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">

                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Banks </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th> name </th>
                                <th> actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $banks as $bank)
                                <tr>
                                    <td> {{ $bank->id }} </td>
                                    <td> {{ $bank->name }} </td>
                                    <td>
                                        <a href="{{ url('banks/edit/'.$bank->id) }}"> Edit </a>
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
