@extends('layouts.app')

@section('title', 'New Investment Rule')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> New Investment Rule </h4>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="/investment_rules/create">
                            @csrf
                            <div class="form-group row">
                                <label for="duration" class="col-sm-4 col-form-label text-md-right">{{ __('Duration') }}</label>

                                <div class="col-md-6">
                                    <input id="duration" type="text" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{ old('duration') }}" required autofocus>

                                    @if ($errors->has('duration'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('duration') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="duration" class="col-sm-4 col-form-label text-md-right">{{ __('Investment Percentage') }}</label>
                                <div class="col-md-6">
                                    {!! Form::text('investment_percentage', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="duration" class="col-sm-4 col-form-label text-md-right">{{ __('Global Percentage') }}</label>
                                <div class="col-md-6">
                                    {!! Form::text('global_percentage', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
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
