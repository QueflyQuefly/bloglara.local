@extends('base')

@section('title', 'Блог ЛарА - Пост')

@section('h1')
    {{ $post->title }}
@endsection

@section('content')
    <div class='mx-5 py-3'>
        <p><small>Автор: {{ $post->user->name }}</small></p>
        <p><small class="text-muted">Последнее изменение {{ $post->updated_at->format('d.m.Y в H:i:s') }}</small></p>
        <p><small class="text-muted">Дата создания {{ $post->created_at->format('d.m.Y в H:i:s') }}</small></p>
    </div>

    <p class="mb-3" style="font-family: 'Tahoma';">{{ $post->content }}</p>

    @auth
        <div class="mb-5">
            <form action='{{ route('post.delete', ['post' => $post->id]) }}'  method="POST">
                @method('DELETE')
                @csrf
                <a href='{{ route('post.edit', ['post' => $post->id]) }}' class="btn btn-primary float-start">Изменить пост</a>
                <button type="submit" class="btn btn-secondary float-end">Удалить пост</button>
            </form>
        </div>
    @endauth
    
    <div class="py-5">
        @include('comment._create')
    </div>
    <div class="py-3">
        <p class="lead">Комментарии:</p>
        @if (!empty($post->comments[0]))
            @foreach ($post->comments as $comment)
                @include('comment._comment')
            @endforeach
        @else
            <p>Пока никто не оставил комментарий. Будьте первым!</p>
        @endif
    </div>
@endsection