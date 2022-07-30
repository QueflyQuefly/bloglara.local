<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text mx-3">
            <small>Автор: {{ $post->user->name }}</small> <br />
            <small class="text-muted">Последнее изменение {{ $post->updated_at->format('d.m.Y в H:i:s') }}</small>
        </p>
        <p class="card-text">
            @if(strlen($post->content > 250))
                {{ substr($post->content, 0, 250) . '...' }}
            @else 
                {{ $post->content }}
            @endif
        </p>
        <a href="{{ route('post.show', ['post' => $post]) }}" class="btn btn-primary float-end">Перейти</a>
    </div>
</div>