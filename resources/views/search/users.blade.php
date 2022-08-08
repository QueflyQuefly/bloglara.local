@extends('base')
 
@section('title', 'Блог ЛарА - Поиск пользователей')

@section('h1', 'Блог ЛарА - Поиск пользователей')

@section('content')
    @include('search._search')

    @if ($users)
        <div class="mt-3 mb-2">
            {{ $users->links() }}
        </div>
        @each('user._user', $users, 'user', 'user._empty')
    @else
        <p class="lead">Нет результатов поиска. Измените поисковый запрос</p>
    @endif
@endsection