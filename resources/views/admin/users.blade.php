@extends('base')

@section('title', 'Блог ЛарА - Админ-панель')

@section('container')
    <div class="container" style="min-height: 70vh;">
        <h1 class='display-4 py-2 text-center'>Управление пользователями</h1>
        <p class='lead text-center'>Нажмите на ID, чтобы посмотреть</p>
        <div  style=" overflow-x: auto;">
            <table class="table table-hover border-top">
                <thead>
                    @include('admin._thead_users')
                </thead>
                <tbody>
                    @each('admin._tbody_users', $users, 'user', 'user._empty')
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
@endsection