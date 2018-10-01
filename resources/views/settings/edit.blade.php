@extends('layouts.app')

@section('title', 'System Settings')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Settings </h4>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="/settings/update">
                            @csrf
                            <div class="form-group row">
                                <label for="app_name" class="col-sm-4 col-form-label text-md-right">{{ __('App Name') }}</label>
                                <div class="col-md-6">
                                    <input id="app_name" type="text" class="form-control{{ $errors->has('app_name') ? ' is-invalid' : '' }}" name="app_name" value="{{ setting('app_name') }}">

                                    @if ($errors->has('app_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('app_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="transaction_time" class="col-sm-4 col-form-label text-md-right">{{ __('Transaction Time') }}</label>
                                <div class="col-md-6">
                                    <input id="transaction_time" type="text" class="form-control{{ $errors->has('transaction_time') ? ' is-invalid' : '' }}" name="transaction_time" value="{{ setting('transaction_time') }}">

                                    @if ($errors->has('transaction_time'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('transaction_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="merge_status" class="col-sm-4 col-form-label text-md-right">{{ __('Merge Engine Status') }}</label>
                                <div class="col-md-6">
                                    <input id="merge_status" type="checkbox" class="{{ $errors->has('transaction_time') ? ' is-invalid' : '' }}" name="merge_status" >
                                </div>
                            </div>
                            {{--<div class="form-group row">--}}
                                {{--<label for="duration" class="col-sm-4 col-form-label text-md-right">{{ __('Investment Percentage') }}</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--{!! Form::text('investment_percentage', null, ['class' => 'form-control']) !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row">--}}
                                {{--<label for="duration" class="col-sm-4 col-form-label text-md-right">{{ __('Global Percentage') }}</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--{!! Form::text('global_percentage', null, ['class' => 'form-control']) !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Settings') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
