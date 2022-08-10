@extends('base')
 
@section('title', 'Блог ЛарА - Поиск постов')

@section('h1', 'Блог ЛарА - Поиск постов')

@section('content')
    @include('search._search')

    @include('search._check_author')

    @include('_errors')

    @if ($posts)
        <p class="lead text-center">Всего на странице постов: {{ count($posts) }} </p>
        <div class="mt-3 mb-2">
            {{ $posts->links() }}
        </div>
        @each('post._post', $posts, 'post', 'post._empty')
    @else
        <p class="lead">Нет результатов поиска. Измените поисковый запрос</p>
    @endif
@endsection