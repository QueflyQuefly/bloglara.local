<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="msapplication-tap-highlight" content="no" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
        <title>@yield('title', 'Base Template')</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        @section('nav')
            @include('_nav')
        @show

        @section('container')
            <div class="container" style="min-height: 70vh; max-width: 900px;">
                <h1 class='display-4 py-4 tezt-break'>@yield('h1', 'Base Template')</h1>
                @yield('content')
            </div>
        @show

        @section('footer')
            @include('_footer')
        @show

        @vite('resources/js/app.js')
    </body>
</html>