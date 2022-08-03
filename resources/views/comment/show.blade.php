@extends('base')

@section('title', 'Блог ЛарА - Изменение комментария')

@section('h1')
    Комментарий №{{ $comment->id }}
@endsection

@section('content')
    @include('comment._comment')
@endsection
