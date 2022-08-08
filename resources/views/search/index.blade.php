@extends('base')
 
@section('title', 'Блог ЛарА - Поиск')

@section('h1', 'Блог ЛарА - Поиск')

@section('content')
    @include('search._search')

    @if ($users || $posts || $comments)
    <div class="py-3">
        <p class="h4 text-center">Пользователи
            @if (count($users) < 5)
                (всего {{ count($users) }})
            @endif
            :
        </p>
        @if (count($users) >= 5)
            <p class="text-center">
                Показаны последние 5 пользователей. 
                <a href="{{ route('search.users', ['search' => $search]) }}">
                    Посмотреть все
                </a>
            </p>
        @endif
        @each('user._user', $users, 'user', 'user._empty')
    </div>
    <div class="py-3">
        <p class="h4 text-center">Посты
            @if (count($posts) < 5)
                (всего {{ count($posts) }})
            @endif
            :
        </p>
        @if (count($posts) >= 5)
            <p class="text-center">
                Показаны последние 5 постов. 
                <a href="{{ route('search.posts', ['search' => $search]) }}">
                    Посмотреть все
                </a>
            </p>
        @endif
        @each('post._post', $posts, 'post', 'post._empty')
    </div>
    <div class="pt-3">
        <p class="h4 text-center">Комментарии
            @if (count($comments) < 5)
                (всего {{ count($comments) }})
            @endif
            :
        </p>
        @if (count($comments) >= 5)
            <p class="text-center">
                Показаны последние 5 комментариев. 
                <a href="{{ route('search.comments', ['search' => $search]) }}">
                    Посмотреть все
                </a>
            </p>
        @endif
        @each('comment._comment', $comments, 'comment', 'comment._empty')
    </div>
    @else
        <p class="lead">Нет результатов поиска. Измените поисковый запрос</p>
    @endif
@endsection