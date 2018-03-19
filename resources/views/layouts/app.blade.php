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
    <nav id="main-navbar" class="navbar navbar-expand-lg bg-white fixed-top navbar-transparent" color-on-scroll="400">
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
                                <a class="dropdown-item" href="{{ url('/profile' .'?'. http_build_query(['member' => strtolower(str_slug(Auth::user()->name)),'profile' => Auth::user()->id ])) }}">
                                    <i class="now-ui-icons users_single-02"></i>
                                    Profile Page
                                </a>
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

        @include('partials.footer')
    </div>

    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-login ">
            <div class="modal-content">
                <div class="card card-login card-plain">
                    <div class="modal-header justify-content-center">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                        </button>

                        <div class="header header-primary text-center">
                            <div class="social-line">
                                <a href="#pablo" class="btn btn-primary btn-icon btn-github btn-round btn-lg">
                                    <i class="fa fa-github"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                        <div class="modal-body">
                            <ul class="nav nav-pills nav-pills-info nav-pills-icons" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " id="link_register" data-toggle="tab" href="#tab_register" role="tablist">
                                        {{-- <i class="now-ui-icons users_single-02"></i> --}}
                                        REGISTER
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" id="link_login" href="#tab_login" role="tablist">
                                        {{-- <i class="now-ui-icons objects_key-25"></i> --}}
                                        SIGN IN
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content tab-space">
                                <div id="success-msg" class="hide">
                                    <div class="alert alert-success" role="alert">
                                        <div class="container">
                                            <div class="alert-icon">
                                                <i class="now-ui-icons ui-2_like"></i>
                                            </div>
                                            <strong>Well done!</strong> Please Confirm your email.!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">
                                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_register">
                                    {{--  Register Form  --}}
                                    <form class="form" method="post" action="" id="register_form">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="now-ui-icons ui-1_email-85"></i></span>
                                                </div>
                                                <input type="email" value="{{ old('email') }}" name="email" id="register_email" class="form-control" placeholder="Your email...">
                                                <span class="text-danger">
                                                    <strong id="email-register-error"></strong>
                                                </span>
                                            </div>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="now-ui-icons users_circle-08"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('name') }}" name="name" id="register_name" class="form-control" placeholder="Name...">
                                                <span class="text-danger">
                                                    <strong id="name-register-error"></strong>
                                                </span>
                                            </div>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="now-ui-icons ui-1_lock-circle-open"></i></span>
                                                </div>
                                                <input type="password" name="password" id="register_password" class="form-control" placeholder="Password...">
                                                <span class="text-danger">
                                                    <strong id="password-register-error"></strong>
                                                </span>
                                            </div>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="now-ui-icons ui-1_lock-circle-open"></i></span>
                                                </div>
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password...">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-block btn-round btn-lg">Register</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_login">
                                    {{--  Login Form  --}}
                                    <form class="form" method="post" action="" id="login_form">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="now-ui-icons ui-1_email-85"></i></span>
                                                </div>
                                                <input type="email" name="email" id="login_email" class="form-control" placeholder="Your Email...">
                                                <span class="text-danger">
                                                    <strong id="email-login-error"></strong>
                                                </span>
                                            </div>

                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="now-ui-icons ui-1_lock-circle-open"></i></span>
                                                </div>
                                                <input type="password" name="password" id="login_password" class="form-control" placeholder="Password...">
                                                <span class="text-danger">
                                                    <strong id="password-login-error"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-block btn-round btn-lg">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <!--   Core JS Files   -->
    <script src="{{ asset('js/manifest.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vendor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.js') }}" type="text/javascript"></script>
    @include('partials.message')
    <script>
        function initMap(){
            var myLatlng = new google.maps.LatLng({{$event->latitude}}, {{$event->longitude}});
            var mapOptions = {
                zoom: 13,
                center: myLatlng,
                scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
                styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
            };

            var map = new google.maps.Map(document.getElementById("contactUs2Map"), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                title:"Hello World!"
            });

            // To add the marker to the map, call setMap();
            marker.setMap(map);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuNtNC5mUcvdU0L2RnHlsqaXLe8Ht4Ddw&callback=initMap" async defer></script>
</body>
</html>
