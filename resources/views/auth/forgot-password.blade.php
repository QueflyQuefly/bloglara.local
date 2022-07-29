@extends('base')

@section('title', 'Блог ЛарА - Восстановление аккаунта')

@section('h1', 'Восстановление аккаунта')

@section('content')
    <div class="mb-3">
        <p class="text-center">{{ __('Забыли пароль? Нет проблем. Введите свой email, на который мы отправим ссылку для восстановления вашего аккаунта. Если у вас еще нет аккаунта - зарегистрируйтесь') }}</p>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class='mb-3'>
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" required autofocus />
            <div id="emailHelp" class="form-text">Введите почту, которую вы указали при регистрации</div>
        </div>

        @include('_errors')

        <div class="mb-3">
            <a class="btn btn-secondary" href="{{ route('register') }}">
                {{ __('Зарегистрироваться') }}
            </a>
            <button class="btn btn-primary float-end">
                {{ __('Подтвердить') }}
            </button>
        </div>
    </form>
@endsection