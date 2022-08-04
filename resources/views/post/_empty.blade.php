<p class="lead">
    Нет информации для отображения. Для создания поста 
    @auth
        перейдите по <a href="{{ route('post.create') }}">ссылке</a>
    @else
        <a href="{{ route('login') }}">войдите</a> и перейдите по <a href="{{ route('post.create') }}">ссылке</a>
    @endauth
</p>