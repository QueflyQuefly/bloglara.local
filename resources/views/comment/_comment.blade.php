<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $comment->user->name }}</h5>
        <p class="card-text mx-3">
            <small class="text-muted">
                @if ($comment->updated_at->format('d.m.Y в H:i:s') === $comment->created_at->format('d.m.Y в H:i:s'))
                    Дата создания {{ $comment->created_at->format('d.m.Y в H:i:s') }}
                @else
                    Последнее изменение {{ $comment->updated_at->format('d.m.Y в H:i:s') }}. <br />
                    Дата создания {{ $comment->created_at->format('d.m.Y в H:i:s') }}
                @endif
            </small>
        </p>
        <p class="card-text">{{ $comment->content }}</p>

        @canany(['update', 'delete'], $comment)
            <form action='{{ route('comment.delete', ['comment' => $comment]) }}'  method="POST">
                @method('DELETE')
                @csrf
                <a href='{{ route('comment.edit', ['comment' => $comment]) }}' class="btn btn-primary float-start">Изменить</a>
                <button type="submit" class="btn btn-secondary float-end">Удалить</button>
            </form>
        @endcanany
    </div>
</div>