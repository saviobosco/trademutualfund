@extends('layouts.app')

@section('title', 'Investments')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Referrals </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> name </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $referrals as $referral)
                                <tr>
                                    <td> {{ $referral['user']['name'] }} </td>
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
