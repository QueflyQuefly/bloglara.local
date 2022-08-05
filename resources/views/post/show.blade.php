@extends('base')

@section('title', 'Блог ЛарА - Пост')

@section('h1')
    {{ $post->title }}
@endsection

@section('content')
    <div class='mx-5 py-1'>
        <p>
            <a href="{{ route('user.show', ['user' => $post['user_id']]) }}" class="nav-link">
                Автор: {{ $post->user->name }}
            </a>

            @if ($post->updated_at === $post->created_at)
                <small class="text-muted">Дата создания {{ $post->created_at }}</small>
            @else
                <small class="text-muted">Последнее изменение {{ $post->updated_at }}</small> <br />
                <small class="text-muted">Дата создания {{ $post->created_at }}</small>
            @endif
        </p>
    </div>

    <div class='py-4'>
        <a href="/storage/{{ $post['image'] }}" target="_blank" title="Открыть в новой вкладке">
            <img src="/storage/{{ $post['image'] }}" class="img-fluid border" alt="Картинка к посту">
        </a>
    </div>

    <p class="mb-3" style="font-family: 'Tahoma';">{!! nl2br($post->content) !!}</p>

    @if (Auth::check() && ((Auth::user()->id === $post['user_id']) || Auth::user()->isAdmin()))
        <div class="mb-5">
            <form action='{{ route('post.delete', ['post' => $post]) }}'  method="POST">
                @method('DELETE')
                @csrf
                <a href='{{ route('post.edit', ['post' => $post]) }}' class="btn btn-primary float-start">Изменить пост</a>
                <button type="submit" class="btn btn-secondary float-end">Удалить пост</button>
            </form>
        </div>
    @endif

    <div class="py-5">
        @include('comment._create')
    </div>
    <div class="py-3">
        <p class="lead">Комментарии ({{ count($comments) }}):</p>

        @each('comment._comment', $comments, 'comment', 'comment._empty')
    </div>
@endsection