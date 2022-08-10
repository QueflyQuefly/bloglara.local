@extends('base')
 
@section('title', 'Блог ЛарА - Комментарии к посту')

@section('h1')
Блог ЛарА - Комментарии к посту <br />
    @if(mb_strlen($post['title'] > 31))
        "{{ mb_substr($post['title'], 0, 30) . '...' }}"
    @else 
        "{{ $post['title'] }}"
    @endif
@endsection

@section('content')
    <div class="pt-3 pb-5">
        @include('comment._create')
    </div>
    <div class="pt-5">
        @each('comment._comment', $comments, 'comment', 'comment._empty')
    </div>
    <div class="mt-3 mb-2">
        {{ $comments->links() }}
    </div>
@endsection