@extends('base')

@section('title', 'Блог ЛарА - Подтверждение пароля')

@section('h1', 'Подтверждение пароля')

@section('content')
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Пожалуйста, подтвердите свой пароль прежде, чем продолжить') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Введите пароль') }}</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
        </div>

        @include('_errors')

        <div class="mb-3">
            <button class="btn btn-primary float-end">
                {{ __('Подтвердить') }}
            </button>
        </div>
    </form>
@endsection