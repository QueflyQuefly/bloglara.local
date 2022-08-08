@extends('base')
 
@section('title', 'Блог ЛарА - Поиск комментариев')

@section('h1', 'Блог ЛарА - Поиск комментариев')

@section('content')
    @include('search._search')

    @if ($comments)
        <div class="mt-3 mb-2">
            {{ $comments->links() }}
        </div>
        @each('comment._comment', $comments, 'comment', 'comment._empty')
    @else
        <p class="lead">Нет результатов поиска. Измените поисковый запрос</p>
    @endif
@endsection