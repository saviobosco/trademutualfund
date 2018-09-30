@extends('layouts.app')

@section('title', 'Create Bank')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Create Bank </h4>
                </div>
                <div class="panel-body">
                    {!! Form::model($bank, ['url' => ['banks/edit', $bank->id] ,'method' => 'PUT']) !!}
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('name', 'Name') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::text('name',null,['class' => 'form-control', 'required' => true]) !!}
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
