@extends('layouts.auth')

@section('content')
<div class="login-content">
    <form method="POST" action="{{ route('login') }}" class="margin-bottom-0">
        @csrf
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
        <div class="checkbox checkbox-css m-b-30">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">
                Remember Me
            </label>
        </div>
        <div class="login-buttons">
            <button type="submit" class="btn btn-success btn-block btn-lg">
                {{ __('sign me in') }}
            </button>
        </div>
        <div class="m-t-20 m-b-40 p-b-40 text-inverse">
            Not a member yet? Click <a href="{{ route('register') }}" class="text-success">here</a> to register.
            <p>
                <a class="text-success" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
                </a>
            </p>
        </div>
        <hr />
        <p class="text-center text-grey-darker">
            &copy; {{ config('app.name') }} All Right Reserved 2018
        </p>
    </form>
</div>
@endsection
