<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        @yield('style')
    </head>
    <body class="bg-gray-100">
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
