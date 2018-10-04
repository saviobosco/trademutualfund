@extends('layouts.auth')

@section('title', 'Register')
@section('content')
<!-- begin register-content -->
<div class="login-content">
    <form method="POST" action="{{ route('register') }}" class="margin-bottom-0">
        @csrf
        <div class="form-group m-b-15">
            <input id="name" type="text" class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group m-b-15">
            <input id="email" type="email" class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group m-b-15">
            <input id="password" type="password" class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group m-b-15">
            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm Password" required>
        </div>

        <div class="form-group m-b-15">
            <input id="phone_number" type="text" class="form-control form-control-lg{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" placeholder="Phone Number" required>

            @if ($errors->has('phone_number'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone_number') }}</strong>
                </span>
            @endif
        </div>

        @if (isset($countries))
            <div class="form-group m-b-15">
                <select class="form-control form-control-lg"  name="country_id" id="country_id" required>
                    @foreach( $countries as $country)
                        <option value="{{$country->id}}"> {{ $country->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('country_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('country_id') }}</strong>
                    </span>
                @endif
            </div>
        @endif

        <div class="form-group m-b-15">
            <input id="password-confirm" type="email" class="form-control form-control-lg" name="referral_email" placeholder="Referral Email (Optional) ">
        </div>

        <div class="login-buttons">
            <button type="submit" class="btn btn-success btn-block btn-lg">
                {{ __('Register') }}
            </button>
        </div>
        <div class="m-t-20 m-b-40 p-b-40 text-inverse">
            Already a member? Click <a href="{{ route('login') }}" class="text-success">here</a> to login.

        </div>
        <hr />
        <p class="text-center text-grey-darker">
            &copy; {{ config('app.name') }} All Right Reserved 2018
        </p>
    </form>
</div>
@endsection
