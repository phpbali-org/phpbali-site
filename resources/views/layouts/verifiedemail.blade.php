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
    @yield('additional-styles')
</head>
<body class="ecommerce-page contact-page">
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg bg-white fixed-top ">
        @include('partials.navbar')
    </nav>
    <div id="app" class="wrapper">
        @yield('content')

        @include('partials.footer')
    </div>
    
    <!-- Scripts -->
    <!--   Core JS Files   -->
    <script src="{{ asset('js/manifest.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vendor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.js') }}" type="text/javascript"></script>
    @include('partials.message')
    {{-- <script>
        function initMap(){
            var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuNtNC5mUcvdU0L2RnHlsqaXLe8Ht4Ddw&callback=initMap" async defer></script> --}}
</body>
</html>
