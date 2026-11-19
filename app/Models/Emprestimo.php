<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $table = 'emprestimos';

    protected $fillable = [
        'livro_id', 'leitor_id', 'data_emprestimo',
        'data_devolucao_prevista', 'data_devolucao', 'status',
    ];

    protected $casts = [
        'data_emprestimo' => 'date',
        'data_devolucao_prevista' => 'date',
        'data_devolucao' => 'date',
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function leitor()
    {
        return $this->belongsTo(Leitor::class);
    }

    public function estaAtrasado(): bool
    {
        return $this->data_devolucao === null && $this->data_devolucao_prevista->lt(today());
    }
}
