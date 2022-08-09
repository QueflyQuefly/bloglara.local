@extends('base')

@section('title', 'Блог ЛарА - Изменение профиля')

@section('h1', 'Изменение данных профиля')

@section('content')
    <form method="POST" action="{{ route('user.update', ['user' => $user]) }}">
        @method('PUT')
        @csrf
        <div class="form-floating mb-3">
            <input 
                id="name" 
                class="form-control" 
                type="text" 
                name="name" 
                value="{{ $user->name }}" 
                aria-describedby="nameHelp" 
                placeholder="Email"
                required 
                autofocus 
            />
            <label for="name">{{ __('Введите фамилию, имя') }}</label>
            <div id="nameHelp" class="form-text">Количество символов: от 1 до 50</div>
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
                autocomplete="new-password" 
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
            <label for="password_confirmation">{{ __('Подтверждение пароля') }}</label>
        </div>

        @include('_errors')

        <div class="mb-3">
            <button class="btn btn-primary float-end">
                {{ __('Подтвердить') }}
            </button>
        </div>
    </form>
@endsection