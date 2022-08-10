@extends('base')
 
@section('title', 'Блог ЛарА - Поиск комментариев')

@section('h1', 'Блог ЛарА - Поиск комментариев')

@section('content')
    @include('search._search')

    @include('search._check_author')

    @include('_errors')

    @if ($comments)
        <p class="lead text-center">Всего на странице комментариев: {{ count($comments) }} </p>
        <div class="mt-3 mb-2">
            {{ $comments->links() }}
        </div>
        @each('comment._comment', $comments, 'comment', 'comment._empty')
    @else
        <p class="lead">Нет результатов поиска. Измените поисковый запрос</p>
    @endif
@endsection