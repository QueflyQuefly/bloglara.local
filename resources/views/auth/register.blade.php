@extends('base')

@section('title', 'Блог ЛарА - Регистрация')

@section('h1', 'Форма регистрации')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-floating mb-3">
            <input 
                id="name" 
                class="form-control" 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                aria-describedby="nameHelp" 
                placeholder="Fio"
                minlength="3"
                maxlength="50"
                required 
                autofocus 
            />
            <label for="name">{{ __('Введите фамилию, имя') }}</label>
            <div id="nameHelp" class="form-text">Количество символов: от 3 до 50</div>
        </div>
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
            <div id="emailHelp" class="form-text">Количество символов: от 3 до 50</div>
        </div>
        <div class="form-floating mb-3">
            <input 
                id="password" 
                class="form-control" 
                type="password" 
                name="password" 
                aria-describedby="passHelp" 
                autocomplete="new-password" 
                placeholder="Password"
                minlength="8"
                maxlength="20"
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
                minlength="8"
                maxlength="20" 
                required 
            />
            <label for="password_confirmation">{{ __('Подтверждение пароля') }}</label>
        </div>

        @include('_errors')

        <div class="mb-3">
            <button class="btn btn-primary float-end">
                {{ __('Зарегистрироваться') }}
            </button>
        </div>
    </form>
@endsection