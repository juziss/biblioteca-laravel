<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livros';

    protected $fillable = [
        'titulo', 'autor', 'editora', 'ano_publicacao', 'isbn', 'quantidade',
    ];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
}
