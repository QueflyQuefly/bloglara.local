<tr>
    <th scope="row"> 
        <a href="{{ route('user.show', ['user' => $user['id']]) }}" class="btn btn-outline">
            <u><b>{{ $user['id'] }}</b></u>
        </a>
    </th>
    <td>
        <a href="{{ route('user.show', ['user' => $user['id']]) }}" class="nav-link">
            <u>{{ $user['name'] }}</u>
        </a>
    </td>
    <td>
        <a href="mailto://{{ $user['email'] }}">Написать на E-mail</a> 
        {{ $user['email'] }}
    </td>
    <td>{{ $user['updated_at'] }}</td>
    <td>{{ $user['created_at'] }}</td>
    <td>
        <a 
            href="{{ route('user.edit', ['user' => $user['id']]) }}" 
            class="btn btn-primary" 
            style="background-image: var(--bs-gradient);"
        >
            Изменить
        </a>
    </td>
    <td>
        <form action='{{ route('user.delete', ['user' => $user['id']]) }}'  method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-secondary" style="background-image: var(--bs-gradient);">
                Удалить
            </button>
        </form>
    </td>
</tr>