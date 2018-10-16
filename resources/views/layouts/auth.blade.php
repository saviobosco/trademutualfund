<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <title>{{ config('app.name', '') }} - @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/4.1.3/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-responsive.css') }}">
</head>
<body>

<div id="page-container">
    <!-- begin login -->
    <div class="login login-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image" style="background-image:linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)), url(/images/hero.jpg)"></div>
            <div class="news-caption">
                <h4 class="caption-title"><b> {{ config('app.name') }} </b></h4>
                <p>
                    {{ setting('tag_line') }}
                </p>
            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
            <!-- begin login-header -->
            <div class="login-header">
                <div class="text-center" class="brand">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="70" width="200">
                    </a>
                </div>
                @include('flash::message')
                @include('element.flash.error')
            </div>
            <!-- end login-header -->
            @yield('content')
        </div>
        <!-- end right-container -->
    </div>
    <!-- end login -->
</div>

<script src="{{ asset('vendors/jquery/jquery-3.3.1.min.js')  }}"></script>
<script src="{{ asset('vendors/bootstrap/4.1.3/js/bootstrap.bundle.min.js')  }}"></script>
<script src="{{ asset('vendors/masked-input/masked-input.min.js')  }}"></script>
<script src="{{ asset('js/guest/register.js')  }}"></script>

</body>
</html>
