@extends('base')

@section('title', 'Блог ЛарА - Админ-панель')

@section('container')
    <div class="container" style="min-height: 70vh;">
        <h1 class='display-4 py-2 text-center'>Управление постами</h1>
        <p class='lead text-center'>Нажмите на ID, чтобы посмотреть</p>
        <hr />
        <div  style=" overflow-x: auto;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Автор</th>
                        <th scope="col">Заголовок</th>
                        <th scope="col">Содержание</th>
                        <th scope="col">Картинка</th>
                        <th scope="col">Изменен</th>
                        <th scope="col">Создан</th>
                        <th scope="col">Изменить</th>
                        <th scope="col">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row"> 
                                <a href="{{ route('post.show', ['post' => $post['id']]) }}" class="nav-link">{{ $post['id'] }}</a>
                            </th>
                            <td>{{ $post['author'] }}</td>
                            <td>
                                @if(mb_strlen($post['title'] > 91))
                                    {{ mb_substr($post['title'], 0, 90) . '...' }}
                                @else 
                                    {{ $post['title'] }}
                                @endif
                            </td>
                            <td>
                                @if(mb_strlen($post['content'] > 121))
                                    {{ mb_substr($post['content'], 0, 120) . '...' }}
                                @else 
                                    {{ $post['content'] }}
                                @endif
                            </td>
                            <td>
                                <a href="/storage/{{ $post['image'] }}" target="_blank" title="Открыть в новой вкладке">
                                    {{ $post['image'] }}
                                </a>
                            </td>
                            <td>{{ $post['updated_at'] }}</td>
                            <td>{{ $post['created_at'] }}</td>
                            <td><a href="{{ route('post.edit', ['post' => $post['id']]) }}" class="btn btn-primary">Изменить</a></td>
                            <td>
                                <form action='{{ route('post.delete', ['post' => $post['id']]) }}'  method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $posts->links() }}
    </div>
@endsection