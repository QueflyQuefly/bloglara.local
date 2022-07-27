@extends('base')

@section('title', 'Блог ЛарА - Пост')

@section('h1')
    {{ $post->title }}
@endsection

@section('content')
    <p class="text"><small class="text-muted">Последнее изменение {{ $post->updated_at }}</small></p>
    <p class="text"><small class="text-muted">Дата создания {{ $post->created_at }}</small></p>
    <p class="text-justify">{{ $post->content }}</p>

    <a href='{{ route('post.edit', ['post' => $post->id]) }}' class="btn btn-primary">Изменить пост</a>
    <form action='{{ route('post.delete', ['post' => $post->id]) }}'  method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-primary" style='float: right'>Удалить пост</button>
    </form>
@endsection