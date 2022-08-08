<div class="container">
    <footer class="py-3 mt-5">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="{{ route('homepage') }}" class="nav-link px-2 text-muted">На главную</a></li>
            @auth
                <li class="nav-item">
                    <a class="nav-link px-3 text-muted" href="{{ route('user.show', ['user' => Auth::user()]) }}">Профиль</a>
                </li>
                <li class="nav-item">
                    <form action='{{ route('logout') }}' method='POST'>
                        @csrf
                        <button type='submit' class="nav-link px-3 text-muted" style='border: none; background-color: inherit;'>Выйти</button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link px-3 text-muted" href="{{ route('login') }}">Войти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 text-muted" href="{{ route('register') }}">Регистрация</a>
                </li>
            @endauth
        </ul>
        <p class="text-center text-muted">&copy; 2022 Blog LarA on Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
    </footer>
</div>