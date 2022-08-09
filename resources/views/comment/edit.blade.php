@extends('base')

@section('title', 'Блог ЛарА - Изменение комментария')

@section('h1', 'Форма изменения комментария')

@section('content')
    <form action='{{ route('comment.update', ['comment' => $comment]) }}' method="POST">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="commentContent" class="form-label">Содержимое комментария</label>
            <textarea 
                name='commentContent' 
                class="form-control" 
                id="commentContent" 
                aria-describedby="textareaHelp" 
                style='height: 10rem' 
                placeholder="Введите содержимое комментария" 
                maxlength="30000"
                required 
                autofocus
            >{{ $comment->content }}</textarea>
            <div id="textareaHelp" class="form-text">Количество символов: от 1 до 30000</div>
        </div>
        <div class="form-check">
            <input type="checkbox" name='commentCheck' class="form-check-input" id="commentCheck" required>
            <label class="form-check-label" for="commentCheck">Согласен с правилами сайта</label>
        </div>

        @include('_errors')

        <button type="submit" class="btn btn-primary float-end">Отправить</button>
    </form>
@endsection