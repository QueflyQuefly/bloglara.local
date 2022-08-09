<tr>
    <th scope="row"> 
        <a href="{{ route('comment.show', ['comment' => $comment['id']]) }}" class="btn btn-outline">
            <u><b>{{ $comment['id'] }}</b></u>
        </a>
    </th>
    <td> 
        <a href="{{ route('post.show', ['post' => $comment['post_id']]) }}" class="btn btn-outline">
            <u>{{ $comment['post_id'] }}</u>
        </a>
    </td>
    <td>
        <a href="{{ route('user.show', ['user' => $comment['user_id']]) }}" class="nav-link">
            <u>{{ $comment['author'] }}</u>
        </a>
    </td>
    <td>
        @if (mb_strlen($comment['content'] > 51))
            {{ mb_substr($comment['content'], 0, 50) . '...' }}
        @else 
            {{ $comment['content'] }}
        @endif
    </td>
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