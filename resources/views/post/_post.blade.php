<a href="{{ route('post.show', ['post' => $post['id']]) }}" class="nav-link">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                    <img src="/storage/{{ $post['image'] }}" class="img-fluid rounded" alt="Картинка к посту">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        @if(mb_strlen($post['title'] > 101))
                            {{ mb_substr($post['title'], 0, 100) . '...' }}
                        @else 
                            {{ $post['title'] }}
                        @endif
                    </h5>
                    <p class="card-text mx-3 mb-1">
                        <small>Автор: {{ $post['author'] }}. </small> 
                        <small class="text-muted">Изменен {{ $post['updated_at'] }}</small>
                    </p>
                    <p class="card-text">
                        @if(mb_strlen($post['content'] > 121))
                            {{ mb_substr($post['content'], 0, 120) . '...' }}
                        @else 
                            {{ $post['content'] }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</a>
