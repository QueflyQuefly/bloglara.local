<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">
            <a href="{{ route('user.show', ['user' => $comment['user_id']]) }}" class="nav-link">
                {{ $comment['author'] }}
            </a>
        </h5>
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

        @if (Auth::check() && ((Auth::user()->id === $comment['user_id']) || Auth::user()->isAdmin()))
            <form action='{{ route('comment.delete', ['comment' => $comment['id']]) }}'  method="POST">
                @method('DELETE')
                @csrf
                <a href='{{ route('comment.edit', ['comment' => $comment['id']]) }}' class="btn btn-primary float-start">Изменить</a>
                <button type="submit" class="btn btn-secondary float-end">Удалить</button>
            </form>
        @endif
    </div>
</div>