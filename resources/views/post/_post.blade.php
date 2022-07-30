<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $post['title'] }}</h5>
        <p class="card-text mx-3">
            <small>Автор: {{ $post['author'] }}</small> <br />
            <small class="text-muted">Последнее изменение {{ $post['updated_at'] }}</small>
        </p>
        <p class="card-text">
            @if(strlen($post['content'] > 250))
                {{ substr($post['content'], 0, 250) . '...' }}
            @else 
                {{ $post['content'] }}
            @endif
        </p>
        <a href="{{ route('post.show', ['post' => $post['id']]) }}" class="btn btn-primary float-end">Перейти</a>
    </div>
</div>