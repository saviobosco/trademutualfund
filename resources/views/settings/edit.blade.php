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
                                    <div class="col-sm-6">
                                        <input type="hidden" name="merge_status" value="0">
                                        <label for="published">
                                            <input type="checkbox" name="merge_status" id="merge_status" value="1" <?= (setting('merge_status')) ? 'checked="checked"' : '' ?> >
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total_users" class="col-sm-4 col-form-label text-md-right">{{ __('Support Email') }}</label>
                                <div class="col-sm-6">
                                    <input id="support_email" type="email" class="form-control" name="support_email" value="{{ setting('support_email') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-offset-4"> </div>
                                <div class="col-sm-6"><h4> Site Statistics </h4></div>
                            </div>
                            <div class="form-group row">
                                <label for="total_users" class="col-sm-4 col-form-label text-md-right">{{ __('Total Users') }}</label>
                                <div class="col-sm-6">
                                    <input id="total_users" type="text" class="form-control" name="total_users" value="{{ setting('total_users') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total_payout" class="col-sm-4 col-form-label text-md-right">{{ __('Total Payout') }}</label>
                                <div class="col-sm-6">
                                    <input id="total_payout" type="text" class="form-control" name="total_payout" value="{{ setting('total_payout') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total_transactions" class="col-sm-4 col-form-label text-md-right">{{ __('Total Transaction') }}</label>
                                <div class="col-sm-6">
                                    <input id="total_transactions" type="text" class="form-control" name="total_transactions" value="{{ setting('total_transactions') }}">
                                </div>
                            </div>

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
