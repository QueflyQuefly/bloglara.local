@extends('base')

@section('title', 'Блог ЛарА - Вход')

@section('h1', 'Форма входа')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-floating mb-3">
            <input 
                id="email" 
                class="form-control" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                aria-describedby="emailHelp" 
                placeholder="Email"
                minlength="3"
                maxlength="50" 
                required 
            />
            <label for="email">Email</label>
            <div id="emailHelp" class="form-text">Количество символов: от 1 до 50</div>
        </div>
        <div class="form-floating mb-3">
            <input 
                id="password" 
                class="form-control" 
                type="password" 
                name="password" 
                aria-describedby="passHelp" 
                autocomplete="current-password" 
                placeholder="Password"
                minlength="8"
                maxlength="20"
                required 
            />
            <label for="password">{{ __('Введите пароль. ') }}</label>
            <div id="passHelp" class="form-text">
                Количество символов: от 8 до 20. 
                <a href="{{ route('password.request') }}">{{ __(' Нажмите здесь, если забыли пароль') }}</a>
            </div>
        </div>
        <div class="mb-3">
            <label for="remember_me" class="form-label">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                {{ __('Запомнить меня') }}
            </label>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        @if ($error = 'These credentials do not match our records.')
                            <li>Неверная почта или пароль</li>
                        @else
                            <li>{{ $error }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        <div class='mb-3'>
            <a class="btn btn-secondary" href="{{ route('register') }}">
                {{ __('Зарегистрироваться') }}
            </a>
            <button class="btn btn-primary float-end">
                {{ __('Войти') }}
            </button>
        </div>
    </form>
@endsection