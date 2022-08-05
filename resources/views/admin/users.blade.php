@extends('base')

@section('title', 'Блог ЛарА - Админ-панель')

@section('container')
    <div class="container" style="min-height: 70vh;">
        <h1 class='display-4 py-2 text-center'>Управление пользователями</h1>
        <p class='lead text-center'>Нажмите на ID, чтобы посмотреть</p>
        <hr />
        <div  style=" overflow-x: auto;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Изменен</th>
                        <th scope="col">Создан</th>
                        <th scope="col">Изменить</th>
                        <th scope="col">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row"> 
                                <a href="{{ route('user.show', ['user' => $user['id']]) }}" class="nav-link">{{ $user['id'] }}</a>
                            </th>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['updated_at'] }}</td>
                            <td>{{ $user['created_at'] }}</td>
                            <td><a href="{{ route('user.edit', ['user' => $user['id']]) }}" class="btn btn-primary">Изменить</a></td>
                            <td>
                                <form action='{{ route('user.delete', ['user' => $user['id']]) }}'  method="POST">
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
        {{ $users->links() }}
    </div>
@endsection