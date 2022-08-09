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
                    <a class="nav-link" href="{{ route('post.create') }}">Создать пост</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Поиск
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('search.index') }}">Поиск</a></li>
                        <li><a class="dropdown-item" href="{{ route('search.users') }}">Пользователей</a></li>
                        <li><a class="dropdown-item" href="{{ route('search.posts') }}">Постов</a></li>
                        <li><a class="dropdown-item" href="{{ route('search.comments') }}">Комментариев</a></li>
                    </ul>
                </li>
                
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.show', ['user' => Auth::user()]) }}">Профиль</a>
                    </li>

                    @if (Auth::user()->isAdmin())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Админ-панель
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('admin.index') }}">Главная</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.users') }}">Пользователи</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.posts') }}">Посты</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.comments') }}">Комментарии</a></li>
                            </ul>
                        </li>
                    @endif

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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
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
            <div  id="navSearch">
                <form class="d-flex" action="{{ route('search.index') }}" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Поисковый запрос" aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>
            </div>
        </div>
    </div>
</nav>