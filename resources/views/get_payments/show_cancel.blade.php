@extends('layouts.app')

@section('title', 'Cancel Get Help')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Cancel Get Help </h4>
                </div>
                <div class="panel-body">
                    {!! Form::model($getPayment,['url' => ['get_payments/cancel', $getPayment->id], 'method'=> 'PUT']) !!}

                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <p> Are you sure you want to cancel this get payment #{{ $getPayment->id }} ? </p>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <a class="btn btn-primary" href="{{ url('/get_payments/index') }}">Go Back</a>
                            <button type="submit" class="btn btn-danger">
                                {{ __('Cancel') }}
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
