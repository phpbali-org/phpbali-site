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
<body class="ecommerce-page">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white fixed-top navbar-transparent" color-on-scroll="500">
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
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#modalLogin" href="">SIGN IN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#modalLogin" href="">REGISTER</a>
                    </li>
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


        <footer class="footer "  data-background-color="black">
            <div class="container">
                <nav>
                    <ul>
                        <li>
                            <a href="https://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://presentation.creative-tim.com">
                               About Us
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                               Blog
                            </a>
                        </li>
                        <li>
                            <a href="https://www.creative-tim.com/license">
                                License
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright">
                    &copy; <script>document.write(new Date().getFullYear())</script>, Designed by <a href="http://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                </div>
            </div>

            
        </footer>
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
                                    <a class="nav-link active" data-toggle="tab" href="#link7" role="tablist">
                                        {{-- <i class="now-ui-icons users_single-02"></i> --}}
                                        REGISTER
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link8" role="tablist">
                                        {{-- <i class="now-ui-icons objects_key-25"></i> --}}
                                        SIGN IN
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content tab-space">
                                <div class="tab-pane active" id="link7">
                                    <form class="form" method="" action="" id="register_form">
                                        <div class="card-body">
                                            <div class="input-group form-group-no-border input-lg">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="now-ui-icons users_circle-08"></i></span>
                                              </div>
                                              <input type="email" name="email" id="register_email" class="form-control" placeholder="Your email...">
                                            </div>
                                            <div class="input-group form-group-no-border input-lg">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="now-ui-icons users_circle-08"></i></span>
                                              </div>
                                              <input type="text" name="name" id="register_name" class="form-control" placeholder="Name...">
                                            </div>
                                            <div class="input-group form-group-no-border input-lg">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="now-ui-icons ui-1_lock-circle-open"></i></span>
                                              </div>
                                              <input type="password" name="password" id="register_password" class="form-control" placeholder="Password...">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-round btn-lg">Login</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="link8">
                                    <form class="form" method="" action="" id="login_form">
                                        <div class="card-body">
                                            <div class="input-group form-group-no-border input-lg">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="now-ui-icons users_circle-08"></i></span>
                                              </div>
                                              <input type="email" name="email" id="login_email" class="form-control" placeholder="Your Email...">
                                            </div>

                                            <div class="input-group form-group-no-border input-lg">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="now-ui-icons ui-1_lock-circle-open"></i></span>
                                              </div>
                                              <input type="password" name="password" id="login_password" class="form-control" placeholder="Password...">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-round btn-lg">Login</button>
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
    <script src="{{ asset('js/require.js') }}" data-main="/js/main.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuNtNC5mUcvdU0L2RnHlsqaXLe8Ht4Ddw"
    async defer></script>
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            nowui.initContactUs2Map();
        });
    </script> -->
</body>
</html>
