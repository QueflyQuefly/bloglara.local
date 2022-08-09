<tr>
    <th scope="row"> 
        <a href="{{ route('post.show', ['post' => $post['id']]) }}" class="btn btn-outline">
            <u><b>{{ $post['id'] }}</b></u>
        </a>
    </th>
    <td>
        <a href="{{ route('user.show', ['user' => $post['user_id']]) }}" class="nav-link">
            <u>{{ $post['author'] }}</u>
        </a>
    </td>
    <td>
        @if (mb_strlen($post['title'] > 51))
            {{ mb_substr($post['title'], 0, 50) . '...' }}
        @else 
            {{ $post['title'] }}
        @endif
    </td>
    <td>
        @if (mb_strlen($post['content'] > 51))
            {{ mb_substr($post['content'], 0, 50) . '...' }}
        @else 
            {{ $post['content'] }}
        @endif
    </td>
    <td>
        <a href="/storage/{{ $post['image'] }}" target="_blank" title="Открыть в новой вкладке">
            <img class="img-fluid" src="/storage/{{ $post['image'] }}" style="max-height: 6rem">
        </a>
    </td>
    <td>{{ $post['updated_at'] }}</td>
    <td>{{ $post['created_at'] }}</td>
    <td>
        <a href="{{ route('post.edit', ['post' => $post['id']]) }}" class="btn btn-primary">
            Изменить
        </a>
    </td>
    <td>
        <form action='{{ route('post.delete', ['post' => $post['id']]) }}'  method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-secondary">Удалить</button>
        </form>
    </td>
</tr>