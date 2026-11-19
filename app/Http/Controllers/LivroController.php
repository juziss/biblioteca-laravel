<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $livros = Livro::when($busca, function ($query, $busca) {
            $query->where(function ($q) use ($busca) {
                $q->where('titulo', 'like', "%{$busca}%")
                    ->orWhere('autor', 'like', "%{$busca}%");
            });
        })->orderBy('titulo')->paginate(10)->withQueryString();

        return view('livros.index', compact('livros', 'busca'));
    }

    public function create()
    {
        return view('livros.create');
    }

    public function store(Request $request)
    {
        Livro::create($this->validar($request));

        return redirect()->route('livros.index')
            ->with('sucesso', 'Livro cadastrado com sucesso!');
    }

    public function edit(Livro $livro)
    {
        return view('livros.edit', compact('livro'));
    }

    public function update(Request $request, Livro $livro)
    {
        $livro->update($this->validar($request, $livro));

        return redirect()->route('livros.index')
            ->with('sucesso', 'Livro atualizado com sucesso!');
    }

    public function destroy(Livro $livro)
    {
        if ($livro->emprestimos()->exists()) {
            return redirect()->route('livros.index')
                ->with('erro', 'Não é possível excluir um livro que possui empréstimos registrados.');
        }

        try {
            $livro->delete();
        } catch (QueryException $e) {
            return redirect()->route('livros.index')
                ->with('erro', 'Não é possível excluir um livro que possui empréstimos registrados.');
        }

        return redirect()->route('livros.index')
            ->with('sucesso', 'Livro excluído com sucesso!');
    }

    private function validar(Request $request, ?Livro $livro = null): array
    {
        return $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editora' => 'nullable|string|max:255',
            'ano_publicacao' => 'nullable|integer|min:1000|max:' . date('Y'),
            'isbn' => ['required', 'string', 'max:30', Rule::unique('livros', 'isbn')->ignore($livro?->id)],
            'quantidade' => 'required|integer|min:0',
        ]);
    }
}
