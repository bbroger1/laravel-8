<!--forma simplificada de chamar as rotas não gera acoplamento, bastando mudar o nome no arquivo de rotas -->
<a href="{{ route('posts.create') }}">Criar novo Post</a>

<hr>

@if (session('message'))
    <div>
        {{session('message')}}
    </div>
@endif
<h1>Posts</h1>

@foreach ($posts as $post)
    <p>
        {{$post->title}}
        [ <a href="{{route('posts.show', $post->id)}}">Ver</a> |
        <a href="{{route('posts.edit', $post->id)}}">Edit</a> ]
    </p>
@endforeach
