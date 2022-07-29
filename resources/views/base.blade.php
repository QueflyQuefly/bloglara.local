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
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('homepage') }}">
                    <img src="/apple-touch-icon.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                    Блог ЛарА
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/post/create">Создать пост</a>
                        </li>

                        @auth
                            <li class="nav-item">
                                <form action='{{ route('logout') }}' method='POST'>
                                    @csrf
                                    <button type='submit' class="nav-link" style='border: none; background-color: inherit;'>Выйти</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Войти</a>
                            </li>
                        @endauth

                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                API
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="">Последние 10 постов</a></li>
                                <li><a class="dropdown-item" href="">Наиболее обсуждаемые посты</a></li>
                                <li><a class="dropdown-item" href="">Третий пост</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item disabled" href="#">Еще что-нибудь</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Поисковый запрос" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Поиск</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container" style="min-height: 100vh; max-width: 900px;">
            <h1 class='display-4 py-4'>@yield('h1', 'Base Template')</h1>
            @yield('content')
        </div>

        
        @section('footer')
            <div class="container">
                <footer class="py-3 my-4">
                    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                        <li class="nav-item"><a href="{{ route('homepage') }}" class="nav-link px-2 text-muted">На главную</a></li>
                        <li class="nav-item"><a href="#" class="nav-link disabled px-2 text-muted disabled">О нас</a></li>
                    </ul>
                    <p class="text-center text-muted">&copy; 2022 Blog LarA on Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
                </footer>
            </div>
        @show

        @vite('resources/js/app.js')
    </body>
</html>