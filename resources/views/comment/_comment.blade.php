<div class="card mb-3">
    <div class="mx-3">
        <p class="lead mt-1 mb-1">{{ $comment->user->name }}</p>
        <div class="mx-3">
            <p>
                <small class="text-muted">
                    Последнее изменение {{ $comment->updated_at->format('d.m.Y в H:i:s') }}. <br />
                    Дата создания {{ $comment->created_at->format('d.m.Y в H:i:s') }}
                </small>
            </p>
        </div>
        <p class="text-justify">{{ $comment->content }}</p>
        @auth
            <div>
                <form action='{{ route('comment.delete', ['comment' => $comment]) }}'  method="POST">
                    @method('DELETE')
                    @csrf
                    <a href='{{ route('comment.edit', ['comment' => $comment]) }}' class="btn btn-primary float-start mb-3">Изменить</a>
                    <button type="submit" class="btn btn-secondary float-end">Удалить</button>
                </form>
            </div>
        @endauth
    </div>
</div>