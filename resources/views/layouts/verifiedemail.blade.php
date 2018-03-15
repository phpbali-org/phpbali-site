<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
    <link href="/css/style.css" rel="stylesheet" />
    <link href="/css/style-app.css" rel="stylesheet" />
    <link rel="canonical" href="{{ url('/') }}" />
    <!--  Social tags      -->
    <meta name="keywords" content="php, php bali, web development, web design, laravel, codeigniter, php bali community, php bali websites, bali php, programmer, bali">
    <meta name="description" content="PHP Bali community websites.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="PHP Bali">
    <meta itemprop="description" content="PHP Bali community websites.">
    <meta itemprop="image" content="http://s3.amazonaws.com/creativetim_bucket/products/56/original/opt_nuk_thumbnail.jpg">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="{{ url('/') }}">
    <meta name="twitter:title" content="PHP Bali">
    <meta name="twitter:description" content="PHP Bali community websites.">
    <meta name="twitter:creator" content="{{ url('/') }}">
    <meta name="twitter:image" content="http://s3.amazonaws.com/creativetim_bucket/products/56/original/opt_nuk_thumbnail.jpg">
    <meta name="twitter:data1" content="PHP Bali community websites.">
    <meta name="twitter:label1" content="About">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="">
    <meta property="og:title" content="PHP Bali community websites." />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:image" content="http://s3.amazonaws.com/creativetim_bucket/products/56/original/opt_nuk_thumbnail.jpg" />
    <meta property="og:description" content="PHP Bali community websites." />
    <meta property="og:site_name" content="PHP Bali" />
</head>
<body class="ecommerce-page contact-page">
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg bg-white " color-on-scroll="500">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="{{ url('/') }}" rel="tooltip" data-placement="bottom" >
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse " data-color="blue" data-nav-image="/img/blurred-image-1.jpg">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="">CODE OF CONDUCT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">MEETUPS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">CONTACT</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">REGISTER</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    {{--  <li class="nav-item">
                        <a class="nav-link modal-toggle" data-tab="tab_login" data-toggle="modal" data-target="#modalLogin" href="#link_login">SIGN IN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link modal-toggle" data-tab="tab_register" data-toggle="modal" data-target="#modalLogin" href="#link_register">REGISTER</a>
                    </li>  --}}
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
                            <i class="fa fa-twitter"></i>
                            <p class="d-lg-none d-xl-none">Twitter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
                            <i class="fa fa-facebook-square"></i>
                            <p class="d-lg-none d-xl-none">Facebook</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="app" class="wrapper">
        @yield('content')

        <footer class="footer footer-big"  data-background-color="black">
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>About Us</h5>
                            <ul class="links-vertical">
                                <li>
                                    <a href="#pablo" class="text-muted">
                                       How to book
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                        Contact US
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                        Help Center
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                        Company Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Other</h5>
                            <ul class="links-vertical">
                                <li>
                                    <a href="#pablo" class="text-muted">
                                       Term & Condition
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                        How to Register
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                       Sell Goods
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                        Receive Payment
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                        Transactions Issues
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                        Affiliates Program
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-2">
                            <h5>Products</h5>
                            <ul class="links-vertical">
                                <li>
                                    <a href="#pablo" class="text-muted">
                                       ACTIVITIES
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                      RESTAURANT
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                      TRANSPORT
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                      GOLF
                                    </a>
                                </li>
                                <li>
                                    <a href="#pablo" class="text-muted">
                                      SPA
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="copyright">
                    Copyright © <script>document.write(new Date().getFullYear())</script> {{ config('app.name') }}.
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Scripts -->
    <!--   Core JS Files   -->
    <script src="{{ asset('js/manifest.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vendor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
    
</body>
</html>
