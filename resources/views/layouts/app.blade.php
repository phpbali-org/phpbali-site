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
        @yield('plugins.css')
        @yield('style')
        @yield('plugins.js')
        @if (config('app.env') === 'production')
            <script src="https://www.google-analytics.com/analytics.js" defer></script>
            <script defer>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                ga('create', 'UA-140501276-1', 'auto');
                ga('send', 'pageview');
            </script>
        @endif
    </head>
    <body>
        <div class="flex flex-col min-h-screen">
            @include('components.header')

            <main class="flex flex-col flex-auto">
                @yield('content')
            </main>

            @include('components.footer')
        </div>

        @yield('script')
    </body>
</html>
