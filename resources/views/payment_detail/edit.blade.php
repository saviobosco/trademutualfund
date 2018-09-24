@extends('layouts.app')

@section('title', 'Edit Profile')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Edit Profile </h4>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($paymentDetail, ['url' => ['/profile/update_payment_info'] ,'method' => 'PUT']) !!}
                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right">
                                {!! Form::label('account_name', 'Account Name') !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::text('account_name',null,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right">
                                {!! Form::label('account_number', 'Account Number') !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::text('account_number',null,['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right">
                                {!! Form::label('bank_name', 'Bank Name') !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::text('bank_name',null,['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right">
                                {!! Form::label('bitcoin_wallet_address', 'Bitcoin Address ') !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::text('bitcoin_wallet_address',null,['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
