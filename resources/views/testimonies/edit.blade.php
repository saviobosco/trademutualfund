@extends('layouts.app')

@section('title', 'Edit Testimony')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Edit Testimony </h4>
                </div>
                <div class="panel-body">
                    {!! Form::model($testimony, ['url' => ['testimonies/edit', $testimony->id] ,'method' => 'PUT']) !!}
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('investment_id', 'Investment Id') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::text('investment_id', null, ['class' => 'form-control', 'disabled' => true]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('user_id', 'User') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'placeholder' => 'select a user...', 'required' => true]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('testimony', 'Testimony') !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::textarea('testimony',null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('published', 'Published') !!}
                        </div>
                        <div class="col-sm-6">
                            <input type="hidden" name="published" value="0">
                            <label for="published">
                                <input type="checkbox" name="published" id="published" value="1" <?= ($testimony->published) ? 'checked="checked"' : '' ?> >
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-form-label text-md-right">
                            {!! Form::label('default', 'Default') !!}
                        </div>
                        <div class="col-sm-6">
                            <input type="hidden" name="default" value="0">
                            <label for="default">
                                <input type="checkbox" name="default" id="default" value="1" <?= ($testimony->default) ? 'checked="checked"' : '' ?> >
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
