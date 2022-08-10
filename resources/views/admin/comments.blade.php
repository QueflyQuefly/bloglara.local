@extends('base')

@section('title', 'Блог ЛарА - Админ-панель')

@section('container')
    <div class="container" style="min-height: 70vh;">
        <h1 class='display-4 py-2 text-center'>Управление комментариями</h1>
        <p class='lead text-center'>Нажмите на ID, чтобы посмотреть</p>
        <div class="overflow-auto">
            <table class="table table-hover border-top">
                <thead>
                    @include('admin._thead_comments')
                </thead>
                <tbody>
                    @each('admin._tbody_comments', $comments, 'comment', 'comment._empty')
                </tbody>
            </table>
        </div>
        {{ $comments->links() }}
    </div>
@endsection