<div class="card mb-3">
    <div class="mx-3">
        <p class="lead py-1">{{ $comment->user->name }}</p>
        <div class="mx-3">
            <p>
                <small class="text-muted">
                    Последнее изменение {{ $post->updated_at->format('d.m.Y в H:i:s') }}. <br />
                    Дата создания {{ $post->created_at->format('d.m.Y в H:i:s') }}
                </small>
            </p>
        </div>
        <p class="text-justify">{{ $comment->content }}</p>
    </div>
</div>