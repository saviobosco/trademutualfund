<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Worlds first decentralized trading and crowd funding mutual community">
    <meta name="keywords" content="trade,peer to peer,bitcoin,investment,trading">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <title>{{ config('app.name', '') }} - Homepage </title>
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
        <div style="background: #080808; color: #fff;">
            <div class="container clearfix">
                <p class="pull-right" style="margin:5px 0px;"> <i class="fa fa-envelope"></i> : {{ setting('support_email') }}  </p>
            </div>
        </div>
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
                        <img src="{{ asset('images/logo-white.png') }}" alt="Logo">
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
            <h3> {{ setting('tag_line') }} </h3>

            <a href="{{ route('register') }}" class="btn btn-outline"> Register </a><br />
            <div class="row home-stats">
                <!-- begin col-3 -->
                <div class="col-md-4 col-4 milestone-col">
                    <div class="milestone">
                        <div class="number"> {{ $totalUsers }} </div>
                        <div class="title"> Users </div>
                    </div>
                </div>
                <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-4 col-4 milestone-col">
                    <div class="milestone">
                        <div class="number">{{ format_decimal($totalPayout) }}</div>
                        <div class="title"> Payouts </div>
                    </div>
                </div>
                <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-md-4 col-4 milestone-col">
                    <div class="milestone">
                        <div class="number" >{{ format_decimal(setting('global_funds_cumulative', 0)) }}</div>
                        <div class="title"> Global Funds</div>
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
            <!-- begin row -->
            <div class="row">
                <!-- begin col-4 -->
                <div class="col-md-12 col-sm-12">
                    <!-- begin about -->
                    <div class="about text-center">
                        <p>
                            Trade Mutual Fund (TMF) is a mutual peer to peer crowd funding community. Your donation grows by 30% weekly while the admin takes 10% of your weekly growth and places it in a central trading account for sustainability. 
                        </p>
                        <div>
                            <h3> 3 investment optional packages </h3>
                            <h4> 10,000 to 200,000  </h4>
                            <p>
                                Fund grows by 30% weekly but 20% would be withdrawn while 10% would be moved to global central trading fund.
                            </p>
                            <h4> 200,000 - 500,000  </h4>
                            <p>
                                You have the option of monthly lock where your money grows by 120% for 30days. 30% is sent to global trading fund
                            </p>
                            <h4> 500,000 - 1,000,000 </h4>
                            <p>
                                Fund goes into master lock where you receive 300% in 3months(optional).
                            </p>
                        </div>
                        <p>
                            Join Us on
                            <a target="_blank" href="https://t.me/joinchat/J6CUKkmOJdB3KqAF57_bpA" class="text-inverse"><i class="fa fa-telegram fa-lg fa-fw text-info"></i> Telegram </a>
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
                    <?php $testimoniesCount = count($testimonies); ?>
                    @if($testimoniesCount >= 1)
                        @for($num = 0; $num < $testimoniesCount; $num++)
                            <!-- begin item -->
                            <div class="carousel-item @if($num === 0) active @endif">
                                <blockquote>
                                    <i class="fa fa-quote-left"></i>
                                    {{ $testimonies[$num]['testimony'] }}
                                    <i class="fa fa-quote-right"></i>
                                </blockquote>
                                <div class="name"> — <span class="text-theme"> {{ $testimonies[$num]['user']['name'] }} </span></div>
                            </div>
                            <!-- end item -->
                        @endfor

                    @else
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
                    @endif
                </div>
                <!-- end carousel-inner -->
                <!-- begin carousel-indicators -->
                <ol class="carousel-indicators m-b-0">
                    @if($testimoniesCount >= 1)
                        @for($num = 0; $num < $testimoniesCount; $num++)
                            <li data-target="#testimonials" data-slide-to="{{$num}}" class="@if($num === 0) active @endif"></li>
                        @endfor
                    @endif
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
