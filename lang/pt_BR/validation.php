<?php

return [
    'after_or_equal' => 'O campo :attribute deve ser uma data igual ou posterior a :date.',
    'date' => 'O campo :attribute deve ser uma data válida.',
    'email' => 'O campo :attribute deve ser um e-mail válido.',
    'exists' => 'O :attribute selecionado é inválido.',
    'integer' => 'O campo :attribute deve ser um número inteiro.',
    'max' => [
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'string' => 'O campo :attribute não pode ter mais que :max caracteres.',
    ],
    'min' => [
        'numeric' => 'O campo :attribute deve ser no mínimo :min.',
        'string' => 'O campo :attribute deve ter no mínimo :min caracteres.',
    ],
    'required' => 'O campo :attribute é obrigatório.',
    'string' => 'O campo :attribute deve ser um texto.',
    'unique' => 'O :attribute informado já está cadastrado.',

    'attributes' => [
        'titulo' => 'título',
        'autor' => 'autor',
        'editora' => 'editora',
        'ano_publicacao' => 'ano de publicação',
        'isbn' => 'ISBN',
        'quantidade' => 'quantidade',
        'nome' => 'nome',
        'cpf' => 'CPF',
        'email' => 'e-mail',
        'telefone' => 'telefone',
        'livro_id' => 'livro',
        'leitor_id' => 'leitor',
        'data_emprestimo' => 'data do empréstimo',
        'data_devolucao_prevista' => 'devolução prevista',
    ],
];
