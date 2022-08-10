<form action='{{ route('comment.store', ['post' => $post]) }}' method="POST">
    @csrf

    <div class="mb-3">
        <label for="commentContent" class="form-label">Содержимое комментария</label>
        <textarea 
            name='commentContent' 
            class="form-control shadow-sm" 
            id="commentContent" 
            aria-describedby="textareaHelp" 
            style='height: 6rem' 
            placeholder="Введите содержимое комментария" 
            maxlength="30000"
            required
        >{{ old('commentContent') }}</textarea>
        <div id="textareaHelp" class="form-text">Количество символов: от 1 до 30000</div>
    </div>
    <div class="form-check">
        <input type="checkbox" name='commentCheck' class="form-check-input shadow-sm" id="commentCheck" required>
        <label class="form-check-label" for="commentCheck">Согласен с правилами сайта</label>
    </div>

    @include('_errors')

    <button type="submit" class="btn btn-primary float-end" style="background-image: var(--bs-gradient);">
        Отправить
    </button>
</form>