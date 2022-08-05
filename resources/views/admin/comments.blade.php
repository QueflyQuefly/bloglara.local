@extends('base')

@section('title', 'Блог ЛарА - Админ-панель')

@section('container')
    <div class="container" style="min-height: 70vh;">
        <h1 class='display-4 py-2 text-center'>Управление комментариями</h1>
        <p class='lead text-center'>Нажмите на ID, чтобы посмотреть</p>
        <hr />
        <div  style=" overflow-x: auto;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Post_ID</th>
                        <th scope="col">Автор</th>
                        <th scope="col">Содержание</th>
                        <th scope="col">Изменен</th>
                        <th scope="col">Создан</th>
                        <th scope="col">Изменить</th>
                        <th scope="col">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <th scope="row"> 
                                <a href="{{ route('comment.show', ['comment' => $comment['id']]) }}" class="nav-link">{{ $comment['id'] }}</a>
                            </th>
                            <td> 
                                <a href="{{ route('post.show', ['post' => $comment['post_id']]) }}" class="nav-link">{{ $comment['post_id'] }}</a>
                            </td>
                            <td>
                                <a href="{{ route('user.show', ['user' => $comment['user_id']]) }}" class="nav-link">{{ $comment['author'] }}</a>
                            </td>
                            <td>{{ $comment['content'] }}</td>
                            <td>{{ $comment['updated_at'] }}</td>
                            <td>{{ $comment['created_at'] }}</td>
                            <td><a href="{{ route('comment.edit', ['comment' => $comment['id']]) }}" class="btn btn-primary">Изменить</a></td>
                            <td>
                                <form action='{{ route('comment.delete', ['comment' => $comment['id']]) }}'  method="POST">
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
        {{ $comments->links() }}
    </div>
@endsection