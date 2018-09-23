@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="widget widget-stats bg-green">
                        <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                        <div class="stats-info">
                            <h4> Investment </h4>
                            <p>3,291,922</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="widget widget-stats bg-green">
                        <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                        <div class="stats-info">
                            <h4> Global Funds </h4>
                            <p>3,291,922</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row ">
                <div class="col-sm-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">

                            <h4 class="panel-title"> Referral Link </h4>
                        </div>
                        <div class="panel-body">
                            <p>{{ auth()->user()->referral_link->getLinkAttribute()  }} </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">

                    <h4 class="panel-title"> Transaction </h4>
                </div>
                <div class="panel-body">
                    @include('element.transactions.transactions', ['url' => '/transactions/active'])
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
