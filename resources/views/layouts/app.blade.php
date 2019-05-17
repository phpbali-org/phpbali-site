<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('style')
    </head>
    <body>
        @include('components.header')

        <main>
            @yield('content')
        </main>

        @include('components.footer')

        @yield('script')
    </body>
</html>
