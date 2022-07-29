@extends('base')

@section('title', 'Блог ЛарА - Вход')

@section('h1', 'Форма входа')

@section('content')
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" aria-describedby="emailHelp" required autofocus />
                <div id="emailHelp" class="form-text">Количество символов: от 1 до 50</div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Пароль') }}</label>
                <input id="password" class="form-control" type="password" name="password" aria-describedby="passHelp" required />
                <div id="passHelp" class="form-text">Количество символов: от 8 до 20</div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('Подтвердите пароль') }}</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
            </div>

            @include('_errors')

            <div class="mb-3">
                <button class="btn btn-primary float-end">
                    {{ __('Сбросить пароль') }}
                </button>
            </div>
        </form>
@endsection