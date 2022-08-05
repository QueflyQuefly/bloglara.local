@extends('base')
 
@section('title', 'Блог ЛарА - Все посты')

@section('h1', 'Блог ЛарА - Все посты')

@section('content')
    <div class="mt-3 mb-2">
        {{ $posts->links() }}
    </div>
    @each('post._post', $posts, 'post', 'post._empty')
@endsection