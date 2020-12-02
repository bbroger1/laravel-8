<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //pode ser usado esses dois metódos para buscar todos os itens do banco
        //$posts = Post::all();
        $posts = Post::get();

        //os dados podem ser enviados para a view dessas duas formas
        /*return view('admin.posts.index', [
            'posts' => $posts
        ]);*/

        //dd($posts); //utilizado para debugar a variável

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        //return view('admin.posts.create');
        dd('arquivo create');
    }

    public function store(StoreUpdatePost $request)
    {
        //criando passando um array no parâmetro
        //por segurança não é legal criar os dados assim sem ter a indicação dos campos $fillable no model

        Post::create($request->all());
        return redirect()
            ->route('posts.index')
            ->with('message', 'Post criado com sucesso');;
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

        $post->update(
            $request->all()
        );

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post editado com sucesso');
    }
}
