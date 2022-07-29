@extends('base')
 
@section('title', 'Блог ЛарА - Главная')

@section('h1', 'Блог ЛарА - Главная')

@section('content')

    @if (! empty($posts[0]))
        @foreach ($posts as $post)
            @include('post._post')
        @endforeach
    @else
        <p class="lead">
            Нет информации для отображения. Для создания поста 
            @auth
                перейдите по <a href="{{ route('post.create') }}">ссылке</a>
            @else
                <a href="{{ route('login') }}">войдите</a> и перейдите по <a href="{{ route('post.create') }}">ссылке</a>
            @endauth
        </p>
    @endif

@endsection