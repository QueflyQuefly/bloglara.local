<div class="card" style="margin-bottom: 1rem">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">
            @if(strlen($post->content > 250))
                {{ substr($post->content, 0, 250) . '...' }}
            @else 
                {{ $post->content }}
            @endif
            </p>
        <p class="card-text"><small class="text-muted">Последнее изменение {{ $post->updated_at->format('d.m.Y в H:i:s') }}</small></p>
        <a href="{{ route('post.show', ['post' => $post]) }}" class="btn btn-primary" style="float: right;">Перейти</a>
    </div>
</div>