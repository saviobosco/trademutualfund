@extends('layouts.app')

@section('title', 'Edit Investment Rules')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">

                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Edit Investment Rule </h4>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($investmentRule, ['url' => ['investment_rules/edit', $investmentRule->id] ,'method' => 'PUT']) !!}
                        @csrf
                        <div class="form-group row">
                            <label for="duration" class="col-sm-4 col-form-label text-md-right">{{ __('Duration') }}</label>

                            <div class="col-md-6">
                                {!! Form::text('duration', null, ['class' => 'form-control']) !!}
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
