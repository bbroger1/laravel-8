@extends('admin.layouts.app')

@section('title', 'Detalhe Posts')

@section('content')


    <h1 class="text-center text-3x1 uppercase font-black my-4">Editar Post - {{ $post->title}}</h1>
    <a href="{{route('posts.index')}}" class="my-4 uppercase px-8 py-2 rounded bg-green-600 text-blue-50 max-w-max shadow-sm hover:shadow-lg">Listar Posts</a>

    <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12 mx-auto">
        <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.posts._partials.form')
        </form>
    </div>
@endsection
