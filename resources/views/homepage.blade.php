@extends('base')
 
@section('title', 'Блог ЛарА - Главная')

@section('h1', 'Блог ЛарА - Главная')

@section('content')
    @each('post._post', $lastPosts, 'post', 'post._empty')

    @if (count($lastPosts) == $numberOfLastPosts)
        <p class="h6 text-center">
            Показаны последние {{ $numberOfLastPosts }} постов. 
            <a href="{{ route('post.index') }}">Посмотреть все</a>
        </p>
    @endif

    @if (count($moreTalkedPosts) > 0)
        <h4 class="text-center mt-5">Наиболее обсуждаемые посты за последнюю неделю</h4>
        @each('post._post', $moreTalkedPosts, 'post', 'post._empty')
    @endif
@endsection