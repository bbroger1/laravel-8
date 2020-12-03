@extends('admin.layouts.app')

@section('title', 'Criar Posts')

@section('content')
    <a href="{{ route('posts.index') }}">Listar Posts</a>

    <h1>Cadastrar novo Post</h1>

    <form action="{{ route('posts.store')}}" method="POST">
        @include('admin.posts._partials.form')
    </form>
@endsection
