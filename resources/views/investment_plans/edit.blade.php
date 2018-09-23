@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Investment Plans </h4>
                </div>
                <div class="panel-body">
                    {!! Form::model($investmentPlan, ['url' => ['investment_plans/edit', $investmentPlan->id] ,'method' => 'PUT']) !!}
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('name', 'Name') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::text('name',null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('minimum_amount', 'Minimum Amount') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::text('minimum_amount',null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('maximum_amount', 'Maximum Amount') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::text('maximum_amount', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
