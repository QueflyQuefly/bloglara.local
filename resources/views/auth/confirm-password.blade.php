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
            <input 
                id="password" 
                class="form-control shadow-sm" 
                type="password" 
                name="password" 
                placeholder="Password"
                required 
                autocomplete="current-password" 
            />
            <label for="password" class="form-label">{{ __('Введите пароль') }}</label>
        </div>

        @include('_errors')

        <div class="mb-3">
            <button class="btn btn-primary float-end" style="background-image: var(--bs-gradient);">
                {{ __('Подтвердить') }}
            </button>
        </div>
    </form>
@endsection