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
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/now-ui-kit.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style-app.css') }}" rel="stylesheet" />
    <link rel="canonical" href="{{ url()->current() }}" />
    @include('partials.meta')
    @yield('additional-styles')
    <style>
        @media screen and (max-width: 991px)
        {
            .navbar{
                padding: 0px 18px;
            }
        }

        @media screen and (max-width: 991px) {
            .navbar-collapse .navbar-nav:not(.navbar-logo) .nav-link:not(.btn) {
                color: #212529 !important;
                font-weight: bold;
            }
            .navbar-collapse[data-color="blue"]:after {
                background: #e9ecef;
            }
        }
    </style>
</head>
<body class="ecommerce-page contact-page">
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
    
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg bg-white fixed-top ">
        @include('partials.navbar')
    </nav>
    <div id="app" class="wrapper">
        @yield('content')

        @include('partials.footer')
    </div>
    
    {{-- Scripts --}}
    <script src="{{ asset('js/manifest.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vendor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.js') }}" type="text/javascript"></script>
    @include('components.alerts.message')
</body>
</html>
