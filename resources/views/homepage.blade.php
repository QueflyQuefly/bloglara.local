@extends('base')
 
@section('title', 'Блог ЛарА - Главная')

@section('h1', 'Блог ЛарА - Главная страница')

@section('content')

    @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="" class="img-fluid rounded-start" alt="Картинка к посту">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        <p class="card-text"><small class="text-muted">Последнее изменение {{ $post->updated_at }}</small></p>
                        <a href="/post/{{ $post->id }}" class="btn btn-primary">Перейти к посту</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection