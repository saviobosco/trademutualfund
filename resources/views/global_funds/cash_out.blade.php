@extends('layouts.app')

@section('title', 'Cash out global fund')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Cash out global fund </h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'global_funds/cash_out']) !!}
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('global_funds', 'Global Funds') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::text('global_funds', $global_funds, ['class' => 'form-control', 'disabled' => true]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('user_id', 'User') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'placeholder' => 'select a user...', 'required' => true]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('amount', 'Amount') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::text('amount',null,['class' => 'form-control', 'required' => true]) !!}
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Cash Out') }}
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
