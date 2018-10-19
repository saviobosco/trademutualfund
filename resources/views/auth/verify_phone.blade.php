@extends('layouts.app')

@section('title', 'Phone Verification')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Phone Number') }}</div>

                    <div class="card-body">
                        <verify-phone-component phone_number="{{ auth()->user()->phone_number }}"></verify-phone-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
