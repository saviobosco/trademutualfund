<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }} - @yield('title') </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{--<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    {{--<link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />--}}
    {{--<script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>--}}
</head>
<body>
    <div id="app">

        <!-- begin #page-container -->
        <div id="page-container" class="page-sidebar-fixed page-header-fixed">
            @include('element.header.header')
            @include('element.sidebar.sidebar')
            <div id="content" class="content">
                @include('flash::message')
                @include('element.flash.error')
                @yield('content')
            </div>
        </div>

        {{--<nav class="navbar navbar-expand-md navbar-light navbar-laravel">--}}
            {{--<div class="container">--}}
                {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                    {{--{{ config('app.name', 'Laravel') }}--}}
                {{--</a>--}}
                {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
                    {{--<span class="navbar-toggler-icon"></span>--}}
                {{--</button>--}}

                {{--<div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
                    {{--<!-- Left Side Of Navbar -->--}}
                    {{--<ul class="navbar-nav mr-auto">--}}

                    {{--</ul>--}}

                    {{--<!-- Right Side Of Navbar -->--}}
                    {{--<ul class="navbar-nav ml-auto">--}}
                        {{--<!-- Authentication Links -->--}}
                        {{--@guest--}}
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                            {{--</li>--}}
                        {{--@else--}}
                            {{--<li class="nav-item dropdown">--}}
                                {{--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                                    {{--Administration <span class="caret"></span>--}}
                                {{--</a>--}}

                                {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
                                    {{--<a class="dropdown-item" href="{{ url('/users/index') }}">{{ __('Users') }}</a>--}}
                                    {{--<a class="dropdown-item" href="{{ url('/investment_plans/index') }}">{{ __('Investment Plans') }}</a>--}}
                                    {{--<a class="dropdown-item" href="{{ url('/investment_rules/index') }}">{{ __('Investment Rules') }}</a>--}}
                                    {{--<a class="dropdown-item" href="">{{ __('Global Funds') }}</a>--}}
                                    {{--<a class="dropdown-item" href="{{ url('/transactions/index') }}">{{ __('Transactions') }}</a>--}}
                                    {{--<a class="dropdown-item" href="{{ url('/make_payments/index') }}">{{ __('Provide Helps') }}</a>--}}
                                    {{--<a class="dropdown-item" href="{{ url('/get_payments/index') }}">{{ __('Get helps') }}</a>--}}
                                    {{--<a class="dropdown-item" href="{{ url('/transaction_reports/index') }}">{{ __('Reports') }}</a>--}}
                                    {{--<hr>--}}
                                    {{--<a class="dropdown-item" href="">{{ __('Settings') }}</a>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="{{ url('home') }}">{{ __('Home') }}</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="{{ url('investments/index') }}">{{ __('Investments') }}</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" href="{{ url('investments/new') }}">{{ __('Start New Invest') }}</a>--}}
                            {{--</li>--}}
                            {{--<li class="nav-item dropdown">--}}
                                {{--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                                    {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                                {{--</a>--}}

                                {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
                                    {{--<a class="dropdown-item" href="{{ url('/profile/view') }}">--}}
                                        {{--{{ __('Profile') }}--}}
                                    {{--</a>--}}
                                    {{--<a class="dropdown-item" href="{{ url('/profile/edit') }}">--}}
                                        {{--{{ __('Edit Profile') }}--}}
                                    {{--</a>--}}
                                    {{--<a class="dropdown-item" href="{{ url('/profile/update_settings') }}">--}}
                                        {{--{{ __('Edit My Settings') }}--}}
                                    {{--</a>--}}
                                    {{--<a class="dropdown-item" href="{{ url('/profile/change_password') }}">--}}
                                        {{--{{ __('Change Password') }}--}}
                                    {{--</a>--}}
                                    {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                                       {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                        {{--{{ __('Logout') }}--}}
                                    {{--</a>--}}

                                    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                        {{--@csrf--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--@endguest--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</nav>--}}

        {{--<main class="py-4">--}}

        {{--</main>--}}
    </div>
</body>
</html>
