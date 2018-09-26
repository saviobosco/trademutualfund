@extends('layouts.app')

@section('title', 'Investments')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Investments </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> id</th>
                                <th> amount investment </th>
                                <th> return on investment </th>
                                <th> global funds amount </th>
                                <th> release date </th>
                                <th> status </th>
                                <th> actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $investments as $investment)
                                <tr>
                                    <td> {{ $investment->id }} </td>
                                    <td> {{ $investment->amount_invested }} </td>
                                    <td> {{ $investment->roi_amount }} </td>
                                    <td> {{ $investment->global_funds_amount }} </td>
                                    <td> {{ $investment->release_date }} </td>
                                    <td>
                                        @switch($investment->status)
                                            @case(1)
                                            <span class="label label-primary"> active </span>
                                                @break
                                            @case(2)
                                            <span class="label label-success"> Confirmed </span>
                                                @break
                                            @case(3)
                                            <span class="label label-success"> cashed_out </span>
                                                @break
                                            @case(4)
                                            <span class="label label-success"> completed </span>
                                                @break
                                            @case(-1)
                                            <span class="label label-danger"> cancelled </span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($investment->status === 1)
                                        <button class="btn btn-danger">
                                            Cancel
                                        </button>
                                        @elseif($investment->status === 2 && $investment->release_date < new \Carbon\Carbon())
                                            <button class="btn btn-danger">
                                                Cash Out
                                            </button>
                                        @endif
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
