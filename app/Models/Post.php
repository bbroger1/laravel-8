<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    //quando existe essa informação apenas os campos da tabela indicados no parâmetro serão preenchidos com o método Post::create($request->all());
    protected $fillable = ['title', 'content'];
}
