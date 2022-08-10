@extends('base')

@section('title', 'Блог ЛарА - Добавление поста')

@section('h1', 'Форма добавления поста')

@section('content')
    <form action='{{ route('post.store') }}' method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-floating mb-3">
            <input 
                type="text" 
                name='postTitle' 
                class="form-control shadow-sm" 
                id="postTitle" 
                aria-describedby="textHelp" 
                value="{{ old('postTitle') }}" 
                placeholder="Введите заголовок поста" 
                maxlength="120"
                required 
                autofocus
            />
            <label for="postTitle">Заголовок</label>
            <div id="textHelp" class="form-text">Количество символов: от 1 до 120</div>
        </div>
        <div class="mb-3">
            <label for="postContent" class="form-label">Содержимое поста</label>
            <textarea 
                name='postContent' 
                class="form-control shadow-sm" 
                id="postContent" 
                aria-describedby="textareaHelp" 
                style='height: 10rem' 
                placeholder="Введите содержимое поста" 
                maxlength="30000"
                required
            >{{ old('postContent') }}</textarea>
            <div id="textareaHelp" class="form-text">Количество символов: от 1 до 30000</div>
        </div>
        <div class="input-group mb-1 shadow-sm">
            <input type="file" class="form-control" id="postImage" name="postImage">
            <label class="input-group-text" for="postImage">Картинка для поста</label>
        </div>
        <div id="imageHelp" class="form-text">
            Картинка должна быть в формате FullHD, менее одного мегабайта. <br /> 
            Если вы не выберите картинку, будет установлена картинка по умолчанию
        </div>
        <div class="mt-3 form-check">
            <input type="checkbox" name='postCheck' class="form-check-input shadow-sm" id="postCheck" required>
            <label class="form-check-label" for="postCheck">Согласен с правилами сайта</label>
        </div>

        @include('_errors')

        <button type="submit" class="btn btn-primary float-end" style="background-image: var(--bs-gradient);">
            Отправить
        </button>
    </form>
@endsection