@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Change Password </h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'profile/change_password','method' => 'PUT']) !!}
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('current_password', 'Current Password') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::password('current_password', ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('password', 'New Password') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('password_confirmation', 'Confirm Password') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Password') }}
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
@endsection
