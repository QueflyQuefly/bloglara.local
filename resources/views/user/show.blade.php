@extends('base')

@section('title', 'Блог ЛарА - Профиль пользователя')

@section('h1')
    {{ $user['name'] }}
@endsection

@section('content')
    <div class='mx-5 py-1'>
        <p>E-mail: {{ $user['email'] }} <br />
        <small class="text-muted">Дата создания профиля {{ $user['created_at'] }}</small>
        
        @if ($user['updated_at'] !== $user['created_at'])
            <small class="text-muted">Последнее изменение {{ $user['updated_at'] }}</small> <br />
        @endif

        </p>
    </div>

    @canany(['update', 'delete'], $user)     
        <div class="pb-5">
            <form action='{{ route('user.delete', ['user' => $user]) }}'  method="POST">
                @method('DELETE')
                @csrf
                <a href='{{ route('user.edit', ['user' => $user]) }}' class="btn btn-primary float-start">Изменить данные аккаунта</a>
                <button type="submit" class="btn btn-secondary float-end">Удалить аккаунт</button>
            </form>
        </div>
    @endcanany

    <div class="mt-5">
        <p class="h4 text-center">Посты пользователя 
            @if (count($posts) < $maxResults)
                (всего {{ count($posts) }})
            @endif
        </p>
        @if (count($posts) == $maxResults)
            <p class="text-center">
                Показаны последние {{ $maxResults }} постов. 
                <a href="{{ route('search.posts', ['search' => $user['name'], 'searchByAuthor' => 'on']) }}">
                    Посмотреть все
                </a>
            </p>
        @endif

        @each('post._post', $posts, 'post', 'post._empty')
    </div>

    <div class="mt-5">
        <p class="h4 text-center">Комментарии пользователя
            @if (count($comments) < $maxResults)
                (всего {{ count($comments) }})
            @endif
        </p>
        @if (count($comments) == $maxResults)
            <p class="text-center">
                Показаны последние {{ $maxResults }} комментариев. 
                <a href="{{ route('search.comments', ['search' => $user['name'], 'searchByAuthor' => 'on']) }}">
                    Посмотреть все
                </a>
            </p>
        @endif

        @each('comment._comment', $comments, 'comment', 'comment._empty')
    </div>
@endsection