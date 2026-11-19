<?php

namespace App\Http\Controllers;

use App\Models\Leitor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeitorController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $leitores = Leitor::when($busca, function ($query, $busca) {
            $query->where('nome', 'like', "%{$busca}%");
        })->orderBy('nome')->paginate(10)->withQueryString();

        return view('leitores.index', compact('leitores', 'busca'));
    }

    public function create()
    {
        return view('leitores.create');
    }

    public function store(Request $request)
    {
        Leitor::create($this->validar($request));

        return redirect()->route('leitores.index')
            ->with('sucesso', 'Leitor cadastrado com sucesso!');
    }

    public function edit(Leitor $leitor)
    {
        return view('leitores.edit', compact('leitor'));
    }

    public function update(Request $request, Leitor $leitor)
    {
        $leitor->update($this->validar($request, $leitor));

        return redirect()->route('leitores.index')
            ->with('sucesso', 'Leitor atualizado com sucesso!');
    }

    public function destroy(Leitor $leitor)
    {
        if ($leitor->emprestimos()->exists()) {
            return redirect()->route('leitores.index')
                ->with('erro', 'Não é possível excluir um leitor que possui empréstimos registrados.');
        }

        try {
            $leitor->delete();
        } catch (QueryException $e) {
            return redirect()->route('leitores.index')
                ->with('erro', 'Não é possível excluir um leitor que possui empréstimos registrados.');
        }

        return redirect()->route('leitores.index')
            ->with('sucesso', 'Leitor excluído com sucesso!');
    }

    private function validar(Request $request, ?Leitor $leitor = null): array
    {
        return $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => ['required', 'string', 'max:14', Rule::unique('leitores', 'cpf')->ignore($leitor?->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('leitores', 'email')->ignore($leitor?->id)],
            'telefone' => 'required|string|max:30',
        ]);
    }
}
