<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $comment['author'] }}</h5>
        <p class="card-text mx-3">
            <small class="text-muted">
                @if ($comment['updated_at'] === $comment['created_at'])
                    Дата создания {{ $comment['created_at'] }}
                @else
                    Последнее изменение {{ $comment['updated_at'] }}. <br />
                    Дата создания {{ $comment['created_at'] }}
                @endif
            </small>
        </p>
        <p class="card-text">{{ $comment['content'] }}</p>

        @auth
        @if (Auth::user()->id === $comment['user_id'])
            <form action='{{ route('comment.delete', ['comment' => $comment['id']]) }}'  method="POST">
                @method('DELETE')
                @csrf
                <a href='{{ route('comment.edit', ['comment' => $comment['id']]) }}' class="btn btn-primary float-start">Изменить</a>
                <button type="submit" class="btn btn-secondary float-end">Удалить</button>
            </form>
        @endif
        @endauth
    </div>
</div>