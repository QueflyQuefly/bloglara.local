@extends('base')

@section('title', 'Блог ЛарА - Изменение поста')

@section('h1', 'Форма изменения поста')

@section('content')
    <form action='{{ route('post.update', ['post' => $post]) }}' method="POST"  enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="postTitle" class="form-label">Заголовок</label>
            <input 
                type="text" 
                name='postTitle' 
                class="form-control" 
                id="postTitle" 
                aria-describedby="textHelp"  
                value="{{ $post->title }}" 
                placeholder="Введите заголовок поста" 
                maxlength="120"
                required 
                autofocus
            >
            <div id="textHelp" class="form-text">Количество символов: от 1 до 120</div>
        </div>
        <div class="mb-3">
            <label for="postContent" class="form-label">Содержимое поста</label>
            <textarea 
                name='postContent' 
                class="form-control" 
                id="postContent" 
                aria-describedby="textareaHelp" 
                style='height: 10rem' 
                placeholder="Введите содержимое поста"
                maxlength="30000" 
                required
            >{{ $post->content }}</textarea>
            <div id="textareaHelp" class="form-text">Количество символов: от 1 до 30000</div>
        </div>
        <div class="input-group mb-1">
            <input type="file" class="form-control" id="postImage" name="postImage">
            <label class="input-group-text" for="postImage">Картинка для поста</label>
        </div>
        <div id="imageHelp" class="form-text">
            Картинка должна быть в формате FullHD, менее одного мегабайта. <br /> 
            Если вы не выберите картинку, будет установлена та картинка, что была
        </div>
        <div class="mt-3 form-check">
            <input type="checkbox" name='postCheck' class="form-check-input" id="postCheck" required>
            <label class="form-check-label" for="postCheck">Согласен с правилами сайта</label>
        </div>

        @include('_errors')

        <button type="submit" class="btn btn-primary float-end">Отправить</button>
    </form>
@endsection