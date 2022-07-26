@extends('base')

@section('title', 'Блог ЛарА - Пост')

@section('h1')
    {{ $post->title }}
@endsection

@section('content')
    <p class="text"><small class="text-muted">Последнее изменение {{ $post->updated_at }}</small></p>
    <p class="text">{{ $post->content }}</p>
@endsection