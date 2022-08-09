@extends('base')

@section('title', 'Блог ЛарА - Регистрация')

@section('h1', 'Форма регистрации')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class='form-label'>{{ __('Введите фамилию, имя') }}</label>
            <input 
                id="name" 
                class="form-control" 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                aria-describedby="nameHelp" 
                minlength="3"
                maxlength="50"
                required 
                autofocus 
            />
            <div id="nameHelp" class="form-text">Количество символов: от 3 до 50</div>
        </div>
        <div class="mb-3">
            <label for="email" class='form-label'>Email</label>
            <input 
                id="email" 
                class="form-control" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                aria-describedby="emailHelp" 
                minlength="3"
                maxlength="50"
                required 
            />
            <div id="emailHelp" class="form-text">Количество символов: от 3 до 50</div>
        </div>
        <div class="mb-3">
            <label for="password" class='form-label'>{{ __('Пароль') }}</label>
            <input 
                id="password" 
                class="form-control" 
                type="password" 
                name="password" 
                aria-describedby="passHelp" 
                autocomplete="new-password" 
                minlength="8"
                maxlength="20"
                required 
            />
            <div id="passHelp" class="form-text">Количество символов: от 8 до 20</div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class='form-label'>{{ __('Подтверждение пароля') }}</label>
            <input 
                id="password_confirmation" 
                class="form-control" 
                type="password" 
                name="password_confirmation"
                minlength="8"
                maxlength="20" 
                required 
            />
        </div>

        @include('_errors')

        <div class="mb-3">
            <button class="btn btn-primary float-end">
                {{ __('Зарегистрироваться') }}
            </button>
        </div>
    </form>
@endsection