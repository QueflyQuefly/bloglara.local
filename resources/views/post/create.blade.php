@extends('base')

@section('title', 'Блог ЛарА - Добавление поста')

@section('h1', 'Форма добавления поста')

@section('content')
    <form action='/post/store' method='post'>
        @csrf
        <div class="mb-3">
            <label for="text" class="form-label">Заголовок</label>
            <input type="text" name='title' class="form-control" id="text" aria-describedby="textHelp"  value="{{ old('title') }}"{{--  required --}}>
            <div id="textHelp" class="form-text">Заголовок может обрезаться до 120 символов</div>
        </div>
        <div class="mb-3">
            <label for="contentPost" class="form-label">Содержимое поста</label>
            <textarea name='content' class="form-control" id="contentPost" aria-describedby="textareaHelp" style='height: 10rem' value="{{ old('content') }}" {{-- required --}}></textarea>
            <div id="textareaHelp" class="form-text">Ограничение в 30000 символов</div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name='check' class="form-check-input" id="check" {{-- required --}}>
            <label class="form-check-label" for="check">Согласен с правилами сайта</label>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection