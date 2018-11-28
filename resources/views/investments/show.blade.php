@extends('layouts.app')

@section('title', 'View Investment')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> View Investment </h4>
                    </div>
                    <div class="panel-body">
                        <p> Id : {{ $investment->id }} </p>
                        <p> Amount Invested : {{ $investment->amount_invested }} </p>
                        <p> ROI Amount : {{ $investment->roi_amount }} </p>
                        <p> Global Funds : {{ $investment->global_funds_amount }} </p>
                        <p> Created Date : {{ $investment->created_at }} </p>
                        <p> Release Date : {{ $investment->release_date }} </p>
                        <p> Status : {{ $investment->status }} </p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-inverse">
                                    <div class="panel-heading">
                                        <div class="panel-title"> Provide Payment </div>
                                    </div>
                                    <div class="panel-body">
                                        @if (isset($investment->make_payment))
                                        <p> Id : {{ $investment->make_payment->id }} </p>
                                        <p> Amount : {{ $investment->make_payment->initial_amount }} </p>
                                        <p> Completed at : {{ $investment->make_payment->completed_at }} </p>
                                        <p> Status : {{ $investment->make_payment->status }} </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="panel panel-inverse">
                                    <div class="panel-heading">
                                        <div class="panel-title"> Get Payment </div>
                                    </div>
                                    <div class="panel-body">
                                        @if (isset($investment->get_payment))
                                        <p> Id : {{ $investment->get_payment->id }} </p>
                                        <p> Amount : {{ $investment->get_payment->initial_amount }} </p>
                                        <p> Completed at : {{ $investment->get_payment->completed_at }} </p>
                                        <p> Status : {{ $investment->get_payment->status }} </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
