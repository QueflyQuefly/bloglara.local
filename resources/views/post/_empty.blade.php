<p class="lead">
    Нет постов для отображения. Для создания поста 

    @unless (Auth::check())
        <a href="{{ route('login') }}">войдите</a> и 
    @endunless

    перейдите по <a href="{{ route('post.create') }}">ссылке</a>
</p>