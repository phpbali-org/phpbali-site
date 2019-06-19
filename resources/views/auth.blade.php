<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        @include('components.header')
        <main class="flex flex-col min-h-screen">
            <div class="flex flex-col items-center m-auto">
                @if (!empty($errors->first()))
                <div role="alert" class="m-4">
                  <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                    Danger
                  </div>
                  <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                      <p>{{ $errors->first() }}</p>
                  </div>
                </div>
                @endif
                <a href="/login/github" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Login with Github</a>
            </div>
        </main>
        @include('components.footer')
    </body>
</html>
