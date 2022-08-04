@extends('base')

@section('title', 'Блог ЛарА - Профиль пользователя')

@section('h1')
    {{ $user->name }}
@endsection

@section('content')
    <div class='mx-5 py-1'>
        <p><small>E-mail: {{ $user->email }}</small> <br />

        @if ($user->updated_at === $user->created_at)
            <small class="text-muted">Дата создания профиля {{ $user->created_at }}</small>
        @else
            <small class="text-muted">Последнее изменение {{ $user->updated_at }}</small> <br />
            <small class="text-muted">Дата создания профиля {{ $user->created_at }}</small>
        @endif
        </p>
    </div>

    @canany(['update', 'delete'], $user)     
        <div class="mb-5">
            <form action='{{ route('user.delete', ['user' => $user]) }}'  method="USER">
                @method('DELETE')
                @csrf
                <a href='{{ route('user.edit', ['user' => $user]) }}' class="btn btn-primary float-start">Изменить</a>
                <button type="submit" class="btn btn-secondary float-end">Удалить пользователя</button>
            </form>
        </div>
    @endcanany

    <p class="lead">Посты пользователя {{ $user->name }} ({{ count($user->comments) }}):</p>
    @each('post._post', $user->posts, 'post', 'post._empty')

    <div class="py-3">
        <p class="lead">Комментарии пользователя {{ $user->name }} ({{ count($user->comments) }}):</p>

        @each('comment._comment', $user->comments, 'comment', 'comment._empty')
    </div>
@endsection