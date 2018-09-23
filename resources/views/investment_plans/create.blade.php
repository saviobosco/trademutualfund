@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Investment Plans </h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'investment_plans/create']) !!}
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

                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('attach_rules', 'Attached Rules') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::select('attach_rules[]', $investmentRules, null, ['class' => 'form-control', 'multiple']) !!}
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
