@extends('base')
 
@section('title', 'Блог ЛарА - Главная')

@section('h1', 'Блог ЛарА - Главная')

@section('content')

    @foreach ($posts as $post)
        @include('post._post')
    @endforeach

@endsection