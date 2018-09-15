<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Styles --}}
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
    @yield('additional-styles')
</head>
<body class="ecommerce-page contact-page">
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
    <nav id="main-navbar" class="navbar navbar-expand-lg bg-white fixed-top navbar-transparent" color-on-scroll="300">
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
    @yield('additional-scripts')
    @if($event)
        <script>
            function initMap(){
                var myLatlng = new google.maps.LatLng({{$event->latitude}}, {{$event->longitude}});
                var mapOptions = {
                    zoom: 13,
                    center: myLatlng,
                    scrollwheel: false,
                    styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
                };

                var map = new google.maps.Map(document.getElementById("contactUs2Map"), mapOptions);

                var marker = new google.maps.Marker({
                    position: myLatlng,
                    title:"<?php echo $event->place; ?>"
                });
                marker.setMap(map);
            };
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuNtNC5mUcvdU0L2RnHlsqaXLe8Ht4Ddw&callback=initMap" async defer></script>
    @endif
</body>
</html>