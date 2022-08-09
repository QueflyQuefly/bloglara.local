@extends('base')

@section('title', 'Блог ЛарА - Вход')

@section('h1', 'Форма входа')

@section('content')
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="form-floating mb-3">
                <input 
                    id="email" 
                    class="form-control" 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $request->email) }}" 
                    aria-describedby="emailHelp" 
                    placeholder="Email"
                    required 
                    autofocus 
                />
                <label for="email">{{ __('Email') }}</label>
                <div id="emailHelp" class="form-text">Количество символов: от 1 до 50</div>
            </div>

            <div class="form-floating mb-3">
                <input 
                    id="password" 
                    class="form-control" 
                    type="password" 
                    name="password" 
                    aria-describedby="passHelp" 
                    placeholder="Password"
                    required 
                />
                <label for="password">{{ __('Пароль') }}</label>
                <div id="passHelp" class="form-text">Количество символов: от 8 до 20</div>
            </div>

            <div class="form-floating mb-3">
                <input 
                    id="password_confirmation" 
                    class="form-control" 
                    type="password" 
                    name="password_confirmation" 
                    placeholder="Password"
                    required 
                />
                <label for="password_confirmation">{{ __('Подтвердите пароль') }}</label>
            </div>

            @include('_errors')

            <div class="mb-3">
                <button class="btn btn-primary float-end">
                    {{ __('Сбросить пароль') }}
                </button>
            </div>
        </form>
@endsection