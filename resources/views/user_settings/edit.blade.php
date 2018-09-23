@extends('layouts.app')

@section('title', 'Edit Settings')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title"> Edit Settings </h4>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($userSettings, ['url' => ['profile/update_settings'] ,'method' => 'PUT']) !!}
                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right">
                                {!! Form::label('email_notification', 'Email Notification') !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('email_notification', 1 ) !!}
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
