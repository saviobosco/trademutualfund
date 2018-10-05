<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Trade Mutual Club ">
    <meta name="keywords" content="trade,peer to peer,bitcoin,investment,trading">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <title>{{ config('app.name', '') }} - @yield('title') </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/4.1.3/css/bootstrap.min.css') }}">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />
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
    </div>
</body>
</html>
