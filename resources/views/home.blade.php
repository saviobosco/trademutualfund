<?php $referral_link = auth()->user()->referral_link->getLinkAttribute(); ?>
@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
<div class="">
    <div class="row">
        {{--<div class="col-md-2 col-sm-6">--}}
            {{--<div class="widget widget-stats bg-green">--}}
                {{--<div class="stats-icon"><i class="fa fa-desktop"></i></div>--}}
                {{--<div class="stats-info">--}}
                    {{--<h4> Donation Fund </h4>--}}
                    {{--<p>0,00</p>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4> Global Funds </h4>
                    <p>{{ setting('global_funds_cumulative') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4> Cash out </h4>
                    <p> {{ $cashAbleInvestments }} </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4> Referral Bonus </h4>
                    <p>{{ $referralBonus }}</p>
                </div>
            </div>
        </div>
        {{--<div class="col-md-2 col-sm-6">--}}
            {{--<div class="widget widget-stats bg-green">--}}
                {{--<div class="stats-icon"><i class="fa fa-desktop"></i></div>--}}
                {{--<div class="stats-info">--}}
                    {{--<h4> Support </h4>--}}
                    {{--<p> {{ $supportTickets }} </p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4> Referrals </h4>
                    <p> {{ $referralsCount }} </p>
                </div>
            </div>
        </div>
    </div>

    @if($investments <= 0)
    <div class="row">
        <div class="col-sm-12">
            <!-- begin card -->
            <div class="card card-outline-danger text-center bg-white">
                <div class="card-block">
                    <blockquote class="card-blockquote">
                        <p class="f-s-14 text-inverse f-w-600"> It seem you don't have any investment yet!</p>
                        <a class="btn btn-sm btn-danger" href="{{ url('/user_investments/create') }}"> Provide Donation </a>
                    </blockquote>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-inverse">
                <div class="panel-heading">

                    <h4 class="panel-title"> Transaction </h4>
                </div>
                <div class="panel-body">
                    @include('element.transactions.transactions', ['url' => '/transactions/active'])
                </div>
            </div>

        </div>
        <div class="col-sm-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">

                    <h4 class="panel-title"> Referral Link </h4>
                </div>
                <div class="panel-body">
                    <p>
                        <a target="_blank" href="{{ $referral_link }}">
                            {{ url('register').'/'.urlencode(auth()->user()->name) }}
                        </a>
                    </p>
                    <p> Share on social media </p>
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $referral_link }}" class="btn btn-primary btn-icon btn-circle btn-lg m-r-10">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a target="_blank" href="https://plus.google.com/share?url={{ $referral_link }}" class="btn btn-info btn-icon btn-circle btn-lg m-r-10">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a target="_blank" href="https://twitter.com/share?url={{ $referral_link }}" class="btn btn-danger btn-icon btn-circle btn-lg">
                        <i class="fa fa-google-plus"></i>
                    </a>


                </div>
            </div>
        </div>
    </div>

</div>
@endsection
