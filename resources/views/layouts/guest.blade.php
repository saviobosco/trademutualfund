<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', '') }} - @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('css/guest/vendors/css/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/guest/vendors/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/guest/vendors/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/guest/resources/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/guest/resources/css/queries.css') }}">
</head>
<body>
<header>
    <nav>
        <div class="row">
            <img src="resources/img/logo-white.png" alt="Trading Mutual Logo" class="logo">
            <img src="resources/img/logo.png" alt="Trading Mutual Logo" class="logo-black">
            <ul class="main-nav js--main-nav">
                <li><a href="#">Home</a></li>
                <li><a href="#works">How it works</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="#plans">Our Accounts</a></li>
            </ul>
            <a class="mobile-nav-icon js--nav-icon"><ion-icon name="menu"></ion-icon></a>
        </div>
    </nav>
    <div class="hero-text-box">
        <h1> Welcome To Our<br> Peer to Peer Network.</h1>
        <a href="login.html" class="btn btn-full ">Login</a>
        <a href="signup.html" class="btn btn-ghost ">Sign Up</a>
    </div>
</header>
<section class="section-features js--section-features" id="features">
    <div class="row">
        <h2>features &mdash; Uses Of Peer to Peer Network.</h2>
        <p class="long-copy">
            Hello, we're Trade Mutual Club, your premium Online Trading service. We know you're always busy. No time to check on your investment.
            So let us take care of that, we're really good at it, we promise!
        </p>
    </div>
    <div class="row js--wp-1">
        <div class="col span-1-of-4 box">
            <ion-icon name="infinite" alt="infinity symbol" class="icon1"></ion-icon>
            <h3>Up to 365 days/year</h3>
            <p >
                Never worry about when to make investment again! We really mean that. Our Online Trading Services include up to 365 days/year coverage. You can also choose to be more flexible,  if that's your style.
            </p>

        </div>
        <div class="col span-1-of-4 box">
            <ion-icon name="alarm" alt="alarm clock"  class="icon1"></ion-icon>
            <h3>Ready in Minutes</h3>
            <p>
                You're only Minutes away from the completion of any Transaction Delivered right from your home. We work with the best Administrators in each section to ensure that you're 100% happy.
            </p>
        </div>
        <div class="col span-1-of-4 box">
            <ion-icon name="cash" alt="cash" class="icon1"></ion-icon>
            <h3>100% Reliable</h3>
            <p >
                All our Transactions, both local and international will be delivered, as we make use of the latest intractive connectivity on a global scale! To  build better business connections and services!
            </p>
        </div>
        <div class="col span-1-of-4 box">
            <ion-icon name="thumbs-up" alt="thumbs-up"  class="icon1"></ion-icon>
            <h3>Do anything</h3>
            <p >
                We don't limit your creativity, which means you can do whatever you feel like. You can also choose from our  multiple Account Options. It's up to you!
            </p>
        </div>
    </div>
</section>
<section class="section-steps" id="works">
    <div class="row">
        <h2 class="clearfix">How it works &mdash; Simple as 1, 2, 3</h2>
    </div>
    <div class="row">
        <div class="col span-1-of-2 step-box">
            <img src="resources/img/app-iphone.png" alt="ominifood app on iphone" class="app-screen js--wp-2">
        </div>
        <div class="col span-1-of-2 step-box">
            <div class="works-step">
                <div>1</div>
                <p>Choose the subscription plan that best fits your needs and sign up today.</p>
            </div>
            <div class="works-step">
                <div>2</div>
                <p>Register and Confirm Your Profile, Or you can even call us!</p>
            </div>
            <div class="works-step">
                <div>3</div>
                <p>Enjoy your online Peer to Peer Services. See you the next time!</p>
            </div>
            <a href="#" class="btn-app"><img src="resources/img/download-app.svg" alt="App Store Button"></a>
            <a href="#" class="btn-app"><img src="resources/img/download-app-android.png" alt="Play Store Button"></a>
        </div>
    </div>
</section>

<section class="section-plans js--section-plans" id="plans">
    <div class="row">
        <h2>Start Banking efficiently today</h2>
    </div>
    <div class="row">
        <div class="col span-1-of-3">
            <div class="plan-box js--wp-4">
                <div>
                    <h3>Domicilary Account</h3>
                    <p class="plan-price">$5,000,000 <span>/ month</span></p>
                    <p class="plan-price-meal">Thats only 5,000.00$ / Transfer </p>
                </div>
                <div>
                    <ul>
                        <li><ion-icon name="checkmark" class="icon-small"></ion-icon><i>Up to $150,000 everyday</i></li>
                        <li><ion-icon name="checkmark" class="icon-small"></ion-icon><i>Transfers 24/7</i></li>
                        <li><ion-icon name="checkmark" class="icon-small"></ion-icon><i>Access to newest creations</i></li>
                        <li><ion-icon name="checkmark" class="icon-small"></ion-icon><i>Service delivery</i></li>
                    </ul>
                </div>
                <div>
                    <a href="#" class="btn btn-full">Sign up now</a>
                </div>
            </div>

        </div>

        <div class="col span-1-of-3">
            <div class="plan-box">
                <div>
                    <h3>Current Account</h3>
                    <p class="plan-price">$2,000,000 <span>/ month</span></p>
                    <p class="plan-price-meal">That's only 2,000.00$ /  Transfer </p>
                </div>
                <div>
                    <ul>
                        <li><ion-icon name="checkmark" class="icon-small"></ion-icon><i>Up to $100,000 everyday</i></li>
                        <li><ion-icon name="checkmark" class="icon-small"></ion-icon><i>Transfers 24/7</i></li>
                        <li><ion-icon name="checkmark" class="icon-small"></ion-icon><i>Access to newest creations</i></li>
                        <li><ion-icon name="checkmark" class="icon-small"></ion-icon><i>Service delivery</i></li>
                    </ul>
                </div>
                <div>
                    <a href="#" class="btn btn-ghost">Sign up now</a>
                </div>
            </div>
        </div>
        <div class="col span-1-of-3">
            <div class="plan-box">
                <div>
                    <h3>Savings Account</h3>
                    <p class="plan-price">$1,000,000 <span>/ month</span></p>
                    <p class="plan-price-meal">&nbsp</p>

                </div>
                <div>
                    <ul>
                        <li><ion-icon name="checkmark" class="icon-small"></ion-icon><i> Up to $10,000 everyday</i></li>
                        <li><ion-icon name="checkmark" class="icon-small"></ion-icon><i>Transfers from 8 am to 12 pm</i></li>
                        <li><ion-icon name="close" class="icon-small"></ion-icon></li>
                        <li><ion-icon name="checkmark" class="icon-small"></ion-icon><i>Service delivery</i></li>
                    </ul>
                </div>
                <div>
                    <a href="#" class="btn btn-ghost">Sign up now</a>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="section-testimonial">
    <div class="row">
        <h2>MEET OUR TOP OFFICIALS</h2>
    </div>
    <div class="row">
        <div class="col span-1-of-3">
            <blockquote>
                Assurance Bank is just awesome! As the MD/CEO i made it our top most priority to deliver the best Online Banking services, sertisfying customers around the globe, making Assurance Bank Plc a life-saver.!
            </blockquote>
            <cite><img src="resources/img/customer-1.jpg"> Mr Cheng Dong (MD/CEO) </cite>

        </div>
        <div class="col span-1-of-3">
            <blockquote>
                Inexpensive, Quick and fast Transfers made right from my home. We have lots of Online Banking Services here in Lisbon, but no one comes even close to Assurance Bank Plc. Me and my family are so in love!
            </blockquote>
            <cite><img src="resources/img/customer-2.jpg"> Joana Silva </cite>

        </div>
        <div class="col span-1-of-3">
            <blockquote>
                I was looking for a quick and easy Online banking service in San Franciso. I tried a lot of them and ended up with Assurance Bank Plc. Best online banking service in the Bay Area. Keep up the great work!
            </blockquote>
            <cite><img src="resources/img/customer-3.jpg"> Milton Chapman</cite>

        </div>
    </div>
</section>
<section class="section-form" id="contact">
    <div class="row">
        <h2>We're happy to hear from you</h2>
    </div>
    <div class="row">
        <form method="post" action="#" class="contact-form">
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="name">Name</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="text" name="name" id="name" placeholder="Your name" required>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="Email">Email</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="Email" name="Email" id="Email" placeholder="Your email" required>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label for="find-us">How did you find us?</label>
                </div>
                <div class="col span-2-of-3">
                    <select name="find-us" id="find-us">
                        <option value="Friends" selected>Friends</option>
                        <option value="Search engine">Search engine</option>
                        <option value="ad">Advertisement</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label>Newsletter?</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="checkbox" name="news" id="news" checked> Yes please
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label>Drop us a line</label>
                </div>
                <div class="col span-2-of-3">
                    <textarea name="message" placeholder="Your message"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <label>&nbsp;</label>
                </div>
                <div class="col span-2-of-3">
                    <input type="submit" value="Send it!">
                </div>
            </div>
        </form>
    </div>
</section>
<footer>
    <div class="row">
        <div class="col span-1-of-2">
            <ul class="footer-nav">
                <li><a href="#">Home</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">iOS App</a></li>
                <li><a href="#">Android App</a></li>
            </ul>
        </div>
        <div class="col span-1-of-2">
            <ul class="social-link">
                <li><a href="#"><ion-icon name="logo-facebook" class="fb"></ion-icon></a></li>
                <li><a href="#"><ion-icon name="logo-twitter" class="tw" ></ion-icon></a></li>
                <li><a href="#"><ion-icon name="logo-googleplus" class="gp"></ion-icon></a></li>
                <li><a href="#"><ion-icon name="logo-instagram" class="ig"></ion-icon></ion-icon></a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <p>
            copyright &copy; 2018, Assurance Bank Plc. All rights reserved.
        </p>
    </div>
</footer>
<script src="https://unpkg.com/ionicons@4.2.4/dist/ionicons.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
<script src="vendors/js/jquery.waypoints.min.js"></script>
<script src="resources/js/script.js"></script>
</body>
</html>
