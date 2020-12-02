<a href="{{ route('posts.index') }}">Listar Posts</a>

<h1>Cadastrar novo Post</h1>

<!-- aqui serão apresentados os erros de validação do formulário
    vindos de HTTP/Requests/StoreUpdatePost.php
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color:red;">{{$error}}</li>
        @endforeach
    </ul>
@endif -->

<form action="{{ route('posts.store')}}" method="POST">
    {{ csrf_field() }}
    <!-- old é um helper do laravel que recupera os dados da request permitindo que, em caso de erro, não se perca os dados preenchidos no input -->
    <input type="text" name="title" id="title" placeholder="Título" value="{{old('title')}}">
    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteúdo">{{old('content')}}</textarea>
    <button type="submit">Enviar</button>
</form>
