<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Scotch.io GuestBook</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link
            href="{{ mix('css/app.css') }}"
            rel="stylesheet"
            type="text/css"
        />
    </head>
    <body>
        <div id="app">
            <nav
                class="flex sticky top-0 bg-white mb-4 px-8 items-center justify-between text-teal-500 border-b shadow flex-wrap p-1" >
                <div>
                    <a class="text-teal-500 text-2xl" href="{{ route('home') }}">GuestBook</a>
                </div>
                <div class="" id="navbar">
                    <a href="{{ route('sign') }}">Sign the GuestBook</a>
                </div>
            </nav>
            @yield('content')
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
