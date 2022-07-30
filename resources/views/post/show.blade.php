@extends('base')

@section('title', 'Блог ЛарА - Пост')

@section('h1')
    {{ $post->title }}
@endsection

@section('content')
    <div class='mx-5 py-1'>
        <p><small>Автор: {{ $post->user->name }}</small> <br />

        @if ($post->updated_at->format('d.m.Y в H:i:s') === $post->created_at->format('d.m.Y в H:i:s'))
            <small class="text-muted">Дата создания {{ $post->created_at->format('d.m.Y в H:i:s') }}</small>
        @else
            <small class="text-muted">Последнее изменение {{ $post->updated_at->format('d.m.Y в H:i:s') }}</small> <br />
            <small class="text-muted">Дата создания {{ $post->created_at->format('d.m.Y в H:i:s') }}</small>
        @endif
        </p>
    </div>

    <p class="mb-3" style="font-family: 'Tahoma';">{{ $post->content }}</p>

    @canany(['update', 'delete'], $post)     
        <div class="mb-5">
            <form action='{{ route('post.delete', ['post' => $post]) }}'  method="POST">
                @method('DELETE')
                @csrf
                <a href='{{ route('post.edit', ['post' => $post]) }}' class="btn btn-primary float-start">Изменить пост</a>
                <button type="submit" class="btn btn-secondary float-end">Удалить пост</button>
            </form>
        </div>
    @endcanany

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