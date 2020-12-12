<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        //pode ser usado esses dois metódos para buscar todos os itens do banco
        //$posts = Post::all();
        //o paginate ordena os dados a serem exibidos - por default apresenta 15 no parâmetro pode ser indicado a quantidade de itens devem ser exibidos
        //para ordernar os itens pode-se usar o orderBy ou o latest para apresentar em ordem decrescente
        //$posts = Post::orderBy('id', 'DESC')->paginate();
        $posts = Post::latest()->paginate();

        //os dados podem ser enviados para a view dessas duas formas
        /*return view('admin.posts.index', [
            'posts' => $posts
        ]);*/

        //dd($posts); //utilizado para debugar a variável

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        //criando passando um array no parâmetro
        //por segurança não é legal criar os dados assim sem ter a indicação dos campos $fillable no model
        $data = $request->all();

        //upload do arquivo
        //captura da imagem pode ser desta forma $request->file('image'); ou na usada abaixo
        if ($request->image->isValid()) {
            //gerar um nome único para o arquivo
            //o helper Str
            $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            //utilizar storeAs para renomear o arquivo
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }


        Post::create($data);
        return redirect()
            ->route('posts.index')
            ->with('message', 'Post criado com sucesso');
    }

    public function show($id)
    {
        //recuperando os dados com where
        // get() retorna uma array com todos os dados e first somente o primeiro registro
        //Post::where('id', $id)->get();
        //$post = Post::where('id', $id)->first();
        //metodo find
        //validar se existe o valor
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        return view('admin.posts.show', compact('post'));
    }

    public function destroy($id)
    {
        if (!$post = Post::find($id)) {
            return redirect()
                ->route('posts.index')
                ->with('message', 'Não foi possível deletar o Post.');
        }

        if (Storage::exists($post->image)) {
            Storage::delete([$post->image]);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post deletado com sucesso');
    }

    public function edit($id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        return view('admin.posts.edit', compact('post'));
    }

    //injetar o request antes do parâmetro
    public function update(StoreUpdatePost $request, $id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        //por segurança não é legal criar os dados assim sem ter a indicação dos campos $fillable no model
        $data = $request->all();

        //upload do arquivo
        //captura da imagem pode ser desta forma $request->file('image'); ou na usada abaixo
        if ($request->image && $request->image->isValid()) {
            if (Storage::exists($post->image)) {
                Storage::delete([$post->image]);
            }
            //gerar um nome único para o arquivo
            //o helper Str
            $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            //utilizar storeAs para renomear o arquivo
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post editado com sucesso');
    }

    public function search(Request $request)
    {
        //para manter a paginação, cria uma variável com as requisições de consuta e passa para a view
        $filters = $request->except('_token');

        $posts = Post::where('title', $request->search)
            ->orWhere('content', 'LIKE', "%{$request->search}%")
            ->paginate(2);

        //para fazer o debug vc pode usar o ->toSql() e fazer um DD na $posts
        /*$posts = Post::where('title', '%{$request->search}%')
            ->orWhere('content', 'LIKE', '%{$request->search}%')
            ->toSql();*/

        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
