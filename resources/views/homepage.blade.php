@extends('base')
 
@section('title', 'Блог ЛарА - Главная')

@section('h1', 'Блог ЛарА - Главная страница')

@section('content')

    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="..." class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        <p class="card-text"><small class="text-muted">Последнее изменение {{ $post->updated_at }}</small></p>
                        <a href="/post/{{ $post->id }}" class="btn btn-primary">Перейти к посту</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection