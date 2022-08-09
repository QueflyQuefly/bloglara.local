@extends('base')

@section('title', 'Блог ЛарА - Админ-панель')

@section('h1', 'Админ-панель')

@section('container')
    <div class="container" style="min-height: 70vh;">
        <h1 class='display-4 py-2 text-center'>Админ-панель</h1>
        <p class="lead text-center">Показаны последние {{ $maxResults }} пользователей, постов, комментариев.</p>

        <div class="my-5">
            <p class='h4 text-center'><a class="nav-link underline" href="{{ route('admin.users') }}">Управление пользователями</a></p>
            <div style=" overflow-x: auto;">
                <table class="table table-striped table-hover border">
                    <thead>
                        @include('admin._thead_users')
                    </thead>
                    <tbody>
                        @each('admin._tbody_users', $users, 'user', 'user._empty')
                    </tbody>
                </table>
            </div>
        </div>

        <div class="my-5">
            <p class='h4 text-center'><a class="nav-link" href="{{ route('admin.posts') }}">Управление постами</a></p>
            <div style=" overflow-x: auto;">
                <table class="table table-striped table-hover border">
                    <thead>
                        @include('admin._thead_posts')
                    </thead>
                    <tbody>
                        @each('admin._tbody_posts', $posts, 'post', 'post._empty')
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-5">
            <p class='h4 text-center'><a class="nav-link" href="{{ route('admin.comments') }}">Управление комментариями</a></p>
            <div style=" overflow-x: auto;">
                <table class="table table-striped table-hover border">
                    <thead>
                        @include('admin._thead_comments')
                    </thead>
                    <tbody>
                        @each('admin._tbody_comments', $comments, 'comment', 'comment._empty')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection