@extends('admin.layouts.app')

@section('title', 'Listagem dos Posts')

@section('content')
    <!--forma simplificada de chamar as rotas não gera acoplamento, bastando mudar o nome no arquivo de rotas -->
    <a href="{{ route('posts.create') }}">Criar novo Post</a>

    <hr>

    @if (session('message'))
        <div>
            {{session('message')}}
        </div>
    @endif

    <h1>Posts</h1>

    <form action="{{route('posts.search')}}" method="POST">
        @csrf
        <input type="text" name="search" id="" placeholder="Digite o título ou ID">
        <button type="submit">Pesquisar</button>
    </form>

    @foreach ($posts as $post)
        <p>
            {{$post->title}}
            [ <a href="{{route('posts.show', $post->id)}}">Ver</a> |
            <a href="{{route('posts.edit', $post->id)}}">Edit</a> ]
        </p>
    @endforeach

    <hr>

    <!-- paginação para manter a paginação quando se pesquisa utiliza o helper appends passando parâmetro recebido o controller-->
    @if (isset($filters))
        {{ $posts->appends($filters)->links() }}
    @else
        {{ $posts->links() }}
    @endif
@endsection
