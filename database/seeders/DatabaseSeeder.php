<?php

namespace Database\Seeders;

use App\Models\Emprestimo;
use App\Models\Leitor;
use App\Models\Livro;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $domCasmurro = Livro::create(['titulo' => 'Dom Casmurro', 'autor' => 'Machado de Assis', 'editora' => 'Principis', 'ano_publicacao' => 1899, 'isbn' => '9788594318602', 'quantidade' => 3]);
        $grandeSertao = Livro::create(['titulo' => 'Grande Sertão: Veredas', 'autor' => 'João Guimarães Rosa', 'editora' => 'Companhia das Letras', 'ano_publicacao' => 1956, 'isbn' => '9788535908770', 'quantidade' => 2]);
        Livro::create(['titulo' => 'A Hora da Estrela', 'autor' => 'Clarice Lispector', 'editora' => 'Rocco', 'ano_publicacao' => 1977, 'isbn' => '9788532508126', 'quantidade' => 1]);
        Livro::create(['titulo' => 'Vidas Secas', 'autor' => 'Graciliano Ramos', 'editora' => 'Record', 'ano_publicacao' => 1938, 'isbn' => '9788501068378', 'quantidade' => 4]);

        $ana = Leitor::create(['nome' => 'Ana Souza', 'cpf' => '123.456.789-00', 'email' => 'ana@email.com', 'telefone' => '(38) 99999-0001']);
        $bruno = Leitor::create(['nome' => 'Bruno Lima', 'cpf' => '987.654.321-00', 'email' => 'bruno@email.com', 'telefone' => '(38) 99999-0002']);

        Emprestimo::create(['livro_id' => $domCasmurro->id, 'leitor_id' => $ana->id, 'data_emprestimo' => today()->subDays(3), 'data_devolucao_prevista' => today()->addDays(4), 'status' => 'Em andamento']);
        $domCasmurro->decrement('quantidade');

        Emprestimo::create(['livro_id' => $grandeSertao->id, 'leitor_id' => $bruno->id, 'data_emprestimo' => today()->subDays(15), 'data_devolucao_prevista' => today()->subDays(5), 'status' => 'Em andamento']);
        $grandeSertao->decrement('quantidade');
    }
}
