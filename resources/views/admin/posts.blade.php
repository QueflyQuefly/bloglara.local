@extends('base')

@section('title', 'Блог ЛарА - Админ-панель')

@section('container')
    <div class="container" style="min-height: 70vh;">
        <h1 class='display-4 py-2 text-center'>Управление постами</h1>
        <p class='lead text-center'>Нажмите на ID, чтобы посмотреть</p>
        <div  style=" overflow-x: auto;">
            <table class="table table-hover border-top">
                <thead>
                    @include('admin._thead_posts')
                </thead>
                <tbody>
                    @each('admin._tbody_posts', $posts, 'post', 'post._empty')
                </tbody>
            </table>
        </div>
        {{ $posts->links() }}
    </div>
@endsection