@extends('layouts.app')

@section('title', 'Update Investment Plan')
@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Update Investment Plan </h4>
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
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('attach_rules', 'Attached Rules') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::select('attach_rules[]', $investmentRules, $investmentAttachedRules, ['class' => 'form-control', 'multiple']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('status', 'Status') !!}
                        </div>
                        <div class="col-sm-6">
                            <input type="hidden" name="status" value="0">
                            <label for="status">
                                <input type="checkbox" name="status" id="status" value="1" <?= ($investmentPlan->status) ? 'checked="checked"' : '' ?> >
                            </label>
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
@endsection
