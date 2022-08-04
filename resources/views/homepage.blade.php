@extends('base')
 
@section('title', 'Блог ЛарА - Главная')

@section('h1', 'Блог ЛарА - Главная')

@section('content')
    @each('post._post', $posts, 'post', 'post._empty')
@endsection