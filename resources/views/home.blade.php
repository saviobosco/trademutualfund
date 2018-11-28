<?php $referral_link = auth()->user()->referral_link->getLinkAttribute(); ?>
@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
<div class="">
    @role('admin')
    <h4> Admin Dashboard View </h4>
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-info">
                    <h4> Users </h4>
                    <p>{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-info">
                    <h4> Global Funds </h4>
                    <p>{{ ($globalFunds) ?  format_decimal($globalFunds) : 0  }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-info">
                    <h4> Active Provide Donations </h4>
                    <p>{{ format_decimal($totalActiveMakePayments) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-info">
                    <h4>Active Investments </h4>
                    <p>{{ format_decimal($totalActiveInvestments) }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-info">
                    <h4>Merged Provide Donation </h4>
                    <p>{{ format_decimal($totalMergedMakePayments) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-info">
                    <h4>Active Get Donation </h4>
                    <p>{{ format_decimal($totalActiveGetPayments) }}</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    @endrole
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-info">
                    <h4> Global Funds </h4>
                    <p>{{ ($globalFundsCumulative) ? format_decimal($globalFundsCumulative) : 0  }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-info">
                    <h4> Cash out </h4>
                    <p> {{ format_decimal($cashAbleInvestments) }} </p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-info">
                    <h4> Referral Bonus </h4>
                    <p>{{ format_decimal($referralBonus) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-info">
                    <h4> Referrals </h4>
                    <p> {{ $referralsCount }} </p>
                </div>
            </div>
        </div>
    </div>

    @if(! $userPaymentDetails['account_number'])
        <div class="row">
            <div class="col-sm-12 alert alert-danger">
              <i class="fa fa-warning"></i>  Payment details is missing. click <a href="{{ url('/profile/update_payment_info') }}"> here </a>  here to add your payment details .
            </div>
        </div>
    @endif

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



                    <div class="input-group">
                        <input id="referral-link" type="text" value="{{ $referral_link }}" class="form-control" aria-describedby="basic-addon2" readonly>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-toggle="tooltip" title="copied" data-clipboard-target="#referral-link" id="copy-ref"> Copy </button>
                        </span>
                    </div>

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
