@extends('base')
 
@section('title', 'Блог ЛарА - Поиск')

@section('h1', 'Блог ЛарА - Поиск')

@section('content')
    @include('search._search')

    @include('_errors')

    <div class="my-3">
        <p class="">
            Также доступен отдельный поиск 
            <a href="{{ route('search.users') }}">пользователей</a>,
            <a href="{{ route('search.posts') }}">постов</a> и 
            <a href="{{ route('search.comments') }}">комментариев</a>.
        </p>
    </div>

    @if ($users || $posts || $comments)
        <div class="py-3">
            <p class="h4 text-center">Пользователи
                @if (count($users) < $maxResults)
                    (всего {{ count($users) }})
                @endif
            </p>
            @if (count($users) == $maxResults)
                <p class="text-center">
                    Показаны последние {{ $maxResults }} пользователей. 
                    <a href="{{ route('search.users', ['search' => $search]) }}">
                        Посмотреть все
                    </a>
                </p>
            @endif
            @each('user._user', $users, 'user', 'user._empty')
        </div>
        <div class="py-3">
            <p class="h4 text-center">Посты
                @if (count($posts) < $maxResults)
                    (всего {{ count($posts) }})
                @endif
            </p>
            @if (count($posts) == $maxResults)
                <p class="text-center">
                    Показаны последние {{ $maxResults }} постов. 
                    <a href="{{ route('search.posts', ['search' => $search]) }}">
                        Посмотреть все
                    </a>
                </p>
            @endif
            @each('post._post', $posts, 'post', 'post._empty')
        </div>
        <div class="pt-3">
            <p class="h4 text-center">Комментарии
                @if (count($comments) < $maxResults)
                    (всего {{ count($comments) }})
                @endif
            </p>
            @if (count($comments) == $maxResults)
                <p class="text-center">
                    Показаны последние {{ $maxResults }} комментариев. 
                    <a href="{{ route('search.comments', ['search' => $search]) }}">
                        Посмотреть все
                    </a>
                </p>
            @endif
            @each('comment._comment', $comments, 'comment', 'comment._empty')
        </div>
    @else
        <p class="lead text-danger">Нет результатов поиска. Измените поисковый запрос</p>
    @endif
@endsection