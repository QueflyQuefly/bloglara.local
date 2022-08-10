@extends('base')

@section('title', 'Блог ЛарА - Верификация email')

@section('h1', 'Верификация email')

@section('content')
    <div class="mb-3">
        <p class="text-center">{{ __('Проверьте свою почту. Если нет письма от нас, то проверьте папку Спам, а также попробуйте отправить письмо еще раз.') }}</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-3 color-green">
            {{ __('Письмо со специальной ссылкой для восстановления доступа к аккаунту успешно отправлено') }}
        </div>
    @endif

    <div>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div class="mb-3">
                <button class="btn btn-primary" style="background-image: var(--bs-gradient);">
                    {{ __('Отправить письмо еще раз') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-secondary" style="background-image: var(--bs-gradient);">
                {{ __('Выйти из аккаунта') }}
            </button>
        </form>
    </div>
@endsection