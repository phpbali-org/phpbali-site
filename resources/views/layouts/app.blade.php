<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name', 'Laravel') }} - {{ $title }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="PHPBali">
        <meta name="description" content="Komunitas pemrograman PHP di Bali. Diskusi tentang PHP dan pengembangan web">
        <meta name="image" content="{{ asset('img/phpbali-logo.png') }}">
        <link rel="icon" type=image/png href="{{ asset('favicon.png') }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:title" content="{{ config('app.name', 'Laravel') }} - {{ $title }}">
        <meta property="og:description" content="Komunitas pemrograman PHP di Bali. Diskusi tentang PHP dan pengembangan web">
        <meta property="og:image" content="{{ asset('img/phpbali-logo.png') }}">
        <meta property="twitter:url" content="{{ config('app.url') }}">
        <meta property="twitter:title" content="{{ config('app.name', 'Laravel') }} - {{ $title }}">
        <meta property="twitter:description" content="Komunitas pemrograman PHP di Bali. Diskusi tentang PHP dan pengembangan web">
        <meta property="twitter:image" content="{{ asset('img/phpbali-logo.png') }}">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        @yield('style')
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
