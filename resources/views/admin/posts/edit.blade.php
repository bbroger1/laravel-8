@extends('admin.layouts.app')

@section('title', 'Detalhe Posts')

@section('content')
    <a href="{{route('posts.index')}}">Listar Posts</a>

    <h1>Editar Post - {{ $post->title}}</h1>

    <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.posts._partials.form')
    </form>
@endsection
