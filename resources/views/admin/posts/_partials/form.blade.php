
<!-- aqui serão apresentados os erros de validação do formulário vindos de HTTP/Requests/StoreUpdatePost.php-->
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color:red;">{{$error}}</li>
        @endforeach
    </ul>
@endif

@csrf
<!-- old é um helper do laravel que recupera os dados da request permitindo que, em caso de erro, não se perca os dados preenchidos no input -->
<input type="file" name="image" id="image">
<input type="text" name="title" id="title" placeholder="Título" value="{{ $post->title ?? old('title')}}">
<textarea name="content" id="content" cols="30" rows="4" placeholder="Conteúdo">{{ $post->content ?? old('content')}}</textarea>
<button type="submit">Enviar</button>
