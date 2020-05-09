<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>{{ isset($title) ? $title.' - ' : null }}{{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="title" content="PHPBali">
        <meta name="description" content="Komunitas pemrograman PHP di Bali. Diskusi tentang PHP dan pengembangan web">
        <meta name="image" content="{{ asset('img/phpbali-logo.png') }}">
        <link rel="icon" type=image/png href="{{ asset('favicon.png') }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:title" content="{{ isset($title) ? $title.' - ' : null }}{{ config('app.name') }}">
        <meta property="og:description" content="Komunitas pemrograman PHP di Bali. Diskusi tentang PHP dan pengembangan web">
        <meta property="og:image" content="{{ asset('img/phpbali-logo.png') }}">
        <meta property="twitter:url" content="{{ config('app.url') }}">
        <meta property="twitter:title" content="{{ isset($title) ? $title.' - ' : null }}{{ config('app.name') }}">
        <meta property="twitter:description" content="Komunitas pemrograman PHP di Bali. Diskusi tentang PHP dan pengembangan web">
        <meta property="twitter:image" content="{{ asset('img/phpbali-logo.png') }}">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @stack('style')
        @if (config('app.env') === 'production')
            <link rel="preconnect" href="https://www.google-analytics.com">
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.defer=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                ga('create', 'UA-140501276-1', 'auto');
                ga('send', 'pageview');
            </script>
        @endif
    </head>
    <body class="bg-gray-100">
        <div class="menu-underlay"></div>
        <div class="flex flex-col min-h-screen">
            @include('components.header')

            <main class="flex flex-col flex-auto">
                @yield('content')
            </main>

            @include('components.footer')
        </div>
        @stack('script')
    </body>
    <script>
        document.querySelector('button.header__hamburger-btn').addEventListener('click', function () {
            document.getElementById('sidebarMenu').style.transform = "translateX(0)";
            document.getElementById('sidebarMenu').style.transition = "transform 250ms ease-in-out";
            document.querySelector('div.menu-underlay').style.display = "block";
            document.querySelector('div.menu-underlay').style.pointerEvents = "auto";
            document.getElementById('sidebarMenu').addEventListener('transitionend', function (e) {
                e.target.style.transitionProperty = "none";
            });
            document.body.style.overflow = "hidden";
        });

        function closeMenu() {
            if (window.matchMedia("(max-width: 767px)").matches) {
                document.getElementById('sidebarMenu').style.transform = "translateX(-250px)";
                document.getElementById('sidebarMenu').style.transition = "transform 250ms ease-in-out";
                document.querySelector('div.menu-underlay').style.display = "none";
                document.querySelector('div.menu-underlay').style.pointerEvents = "none";
                document.getElementById('sidebarMenu').addEventListener('transitionend', function (e) {
                e.target.style.transitionProperty = "none";
                });
                document.body.style.overflow = "visible";
            }
        }

        document.querySelector('button.nav__hide-btn').addEventListener('click', function () {
            closeMenu();
        });

        document.querySelector('div.menu-underlay').addEventListener('click', function () {
            closeMenu();
        });
        // For toggle logout button
        const $avatarBtn = document.getElementById('avatarBtn');
        if ($avatarBtn !== null) {
            $avatarBtn.addEventListener('click', e => {
                const $logoutField = document.getElementById('logoutField');
                if ($logoutField.classList.contains("hidden")) {
                    $logoutField.classList.remove("hidden");
                    $logoutField.classList.add("block");
                } else {
                    $logoutField.classList.remove("block");
                    $logoutField.classList.add("hidden");
                }
            });
        }
    </script>
</html>
