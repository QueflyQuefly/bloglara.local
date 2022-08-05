@extends('base')

@section('title', 'Блог ЛарА - Изменение профиля')

@section('h1', 'Изменение данных профиля')

@section('content')
    <form method="POST" action="{{ route('user.update', ['user' => $user]) }}">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class='form-label'>{{ __('Введите фамилию, имя') }}</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ $user->name }}" aria-describedby="nameHelp" required autofocus />
            <div id="nameHelp" class="form-text">Количество символов: от 1 до 50</div>
        </div>
        <div class="mb-3">
            <label for="password" class='form-label'>{{ __('Пароль') }}</label>
            <input id="password" class="form-control" type="password" name="password" aria-describedby="passHelp" required autocomplete="new-password" />
            <div id="passHelp" class="form-text">Количество символов: от 8 до 20</div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class='form-label'>{{ __('Подтверждение пароля') }}</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
        </div>

        @include('_errors')

        <div class="mb-3">
            <button class="btn btn-primary float-end">
                {{ __('Подтвердить') }}
            </button>
        </div>
    </form>
@endsection