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
    <link rel="stylesheet" href="{{ asset('css/guest/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/guest/style-responsive.css') }}">
</head>
<body>
<!-- begin #page-container -->
<div id="page-container">
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-transparent navbar-fixed-top">
        <!-- begin container -->
        <div class="container">
            <!-- begin navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.html" class="navbar-brand">
                    <picture>
                        <img src="{{ asset('images/logo-white.png') }}" alt="Logo" >
                    </picture>
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- begin navbar-collapse -->
            <div class="collapse navbar-collapse" id="header-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}" > Login </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" > Register </a></li>
                </ul>
            </div>
            <!-- end navbar-collapse -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #header -->

    <!-- begin #home -->
    <div id="home" class="content has-bg home" style="height: 332px;">
        <!-- begin content-bg -->
        <div class="content-bg" style="background-image:linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)), url(/images/hero.jpg);"
             data-paroller="true"
             data-paroller-factor="0.5"
             data-paroller-factor-xs="0.25">
        </div>
        <!-- end content-bg -->
        <!-- begin container -->
        <div class="container home-content">
            <h1>Welcome to {{ config('app.name') }}</h1>
            <h3> Another Description here </h3>

            <a href="{{ route('register') }}" class="btn btn-outline"> Start Now! </a><br />
            <div class="row home-stats">
                <!-- begin col-3 -->
                <div class="col-md-4 col-4 milestone-col">
                    <div class="milestone">
                        <div class="number" data-animation="true" data-animation-type="number" data-final-number="1292">1,292</div>
                        <div class="title"> Users </div>
                    </div>
                </div>
                <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-4 col-4 milestone-col">
                    <div class="milestone">
                        <div class="number" data-animation="true" data-animation-type="number" data-final-number="9039">9,039</div>
                        <div class="title"> Payouts </div>
                    </div>
                </div>
                <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-4 col-4 milestone-col">
                    <div class="milestone">
                        <div class="number" data-animation="true" data-animation-type="number" data-final-number="89291">89,291</div>
                        <div class="title"> Total Transactions </div>
                    </div>
                </div>
                <!-- end col-3 -->
            </div>
        </div>
        <!-- end container -->
        <div class="container">
            <!-- begin row -->

            <!-- end row -->
        </div>

    </div>
    <!-- end #home -->

    <!-- begin #about -->
    <div id="about" class="content" data-scrollview="true">
        <!-- begin container -->
        <div class="container" data-animation="true" data-animation-type="fadeInDown">
            <h2 class="content-title">About Us</h2>
            <p class="content-desc">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
                sed bibendum turpis luctus eget
            </p>
            <!-- begin row -->
            <div class="row">
                <!-- begin col-4 -->
                <div class="col-md-12 col-sm-12">
                    <!-- begin about -->
                    <div class="about">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Vestibulum posuere augue eget ante porttitor fringilla.
                            Aliquam laoreet, sem eu dapibus congue, velit justo ullamcorper urna,
                            non rutrum dolor risus non sapien. Vivamus vel tincidunt quam.
                            Donec ultrices nisl ipsum, sed elementum ex dictum nec.
                        </p>
                        <p>
                            In non libero at orci rutrum viverra at ac felis.
                            Curabitur a efficitur libero, eu finibus quam.
                            Pellentesque pretium ante vitae est molestie, ut faucibus tortor commodo.
                            Donec gravida, eros ac pretium cursus, est erat dapibus quam,
                            sit amet dapibus nisl magna sit amet orci.
                        </p>
                    </div>
                    <!-- end about -->
                </div>
                <!-- end col-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #about -->


    <!-- begin #client -->
    <div id="client" class="content has-bg" data-scrollview="true" >
        <!-- begin content-bg -->
        <div class="content-bg" style="background-image:linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7)),  url('/images/hero5.jpg')"
             data-paroller-factor="0.5"
             data-paroller-factor-md="0.01"
             data-paroller-factor-xs="0.01">
        </div>
        <!-- end content-bg -->
        <!-- begin container -->
        <div class="container" data-animation="true" data-animation-type="fadeInUp">
            <h2 class="content-title">Our Client Testimonials</h2>
            <!-- begin carousel -->
            <div class="carousel testimonials slide" data-ride="carousel" id="testimonials">
                <!-- begin carousel-inner -->
                <div class="carousel-inner text-center">
                    <!-- begin item -->
                    <div class="carousel-item active">
                        <blockquote>
                            <i class="fa fa-quote-left"></i>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce viverra, nulla ut interdum fringilla,<br />
                            urna massa cursus lectus, eget rutrum lectus neque non ex.
                            <i class="fa fa-quote-right"></i>
                        </blockquote>
                        <div class="name"> — <span class="text-theme">Mark Doe</span>, Designer</div>
                    </div>
                    <!-- end item -->
                    <!-- begin item -->
                    <div class="carousel-item">
                        <blockquote>
                            <i class="fa fa-quote-left"></i>
                            Donec cursus ligula at ante vulputate laoreet. Nulla egestas sit amet lorem non bibendum.<br />
                            Nulla eget risus velit. Pellentesque tincidunt velit vitae tincidunt finibus.
                            <i class="fa fa-quote-right"></i>
                        </blockquote>
                        <div class="name"> — <span class="text-theme">Joe Smith</span>, Developer</div>
                    </div>
                    <!-- end item -->
                    <!-- begin item -->
                    <div class="carousel-item">
                        <blockquote>
                            <i class="fa fa-quote-left"></i>
                            Sed tincidunt quis est sed ultrices. Sed feugiat auctor ipsum, sit amet accumsan elit vestibulum<br />
                            fringilla. In sollicitudin ac ligula eget vestibulum.
                            <i class="fa fa-quote-right"></i>
                        </blockquote>
                        <div class="name"> — <span class="text-theme">Linda Adams</span>, Programmer</div>
                    </div>
                    <!-- end item -->
                </div>
                <!-- end carousel-inner -->
                <!-- begin carousel-indicators -->
                <ol class="carousel-indicators m-b-0">
                    <li data-target="#testimonials" data-slide-to="0" class="active"></li>
                    <li data-target="#testimonials" data-slide-to="1" class=""></li>
                    <li data-target="#testimonials" data-slide-to="2" class=""></li>
                </ol>
                <!-- end carousel-indicators -->
            </div>
            <!-- end carousel -->
        </div>
        <!-- end containter -->
    </div>
    <!-- end #client -->

    <!-- begin #footer -->
    <div id="footer" class="footer">
        <div class="container">
            <p>
                &copy; Copyright {{ config('app.name') }} 2018 <br />
            </p>

        </div>
    </div>
    <!-- end #footer -->
</div>
<!-- end #page-container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('vendors/jquery/jquery-3.3.1.min.js')  }}"></script>
<script src="{{ asset('vendors/bootstrap/4.1.3/js/bootstrap.bundle.min.js')  }}"></script>
<!--[if lt IE 9]>
<script src="{{ asset('js/crossbrowserjs/html5shiv.js')  }}"></script>
<script src="{{ asset('js/crossbrowserjs/respond.min.js')  }}"></script>
<script src="{{ asset('js/crossbrowserjs/excanvas.min.js')  }}"></script>
<![endif]-->
<script src="{{ asset('vendors/paroller/jquery.paroller.min.js') }}"></script>
<script src="{{ asset('js/guest/apps.js')  }}"></script>
<!-- ================== END BASE JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
    });
</script>
</body>
</html>
