<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Leitor;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EmprestimoController extends Controller
{
    public function index(Request $request)
    {
        $query = Emprestimo::with(['livro', 'leitor']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->boolean('atrasados')) {
            $query->whereNull('data_devolucao')
                ->whereDate('data_devolucao_prevista', '<', today());
        }

        $emprestimos = $query->orderByDesc('data_emprestimo')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create()
    {
        $leitores = Leitor::orderBy('nome')->get();
        $livros = Livro::where('quantidade', '>', 0)->orderBy('titulo')->get();

        return view('emprestimos.create', compact('leitores', 'livros'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'livro_id' => 'required|exists:livros,id',
            'leitor_id' => 'required|exists:leitores,id',
            'data_emprestimo' => 'required|date',
            'data_devolucao_prevista' => 'required|date|after_or_equal:data_emprestimo',
        ]);

        DB::transaction(function () use ($dados) {
            $livro = Livro::whereKey($dados['livro_id'])->lockForUpdate()->firstOrFail();

            if ($livro->quantidade < 1) {
                throw ValidationException::withMessages([
                    'livro_id' => 'Não há exemplares disponíveis deste livro.',
                ]);
            }

            $livro->decrement('quantidade');

            Emprestimo::create([
                'livro_id' => $dados['livro_id'],
                'leitor_id' => $dados['leitor_id'],
                'data_emprestimo' => $dados['data_emprestimo'],
                'data_devolucao_prevista' => $dados['data_devolucao_prevista'],
                'status' => 'Em andamento',
            ]);
        });

        return redirect()->route('emprestimos.index')
            ->with('sucesso', 'Empréstimo registrado com sucesso!');
    }

    public function devolver(Emprestimo $emprestimo)
    {
        DB::transaction(function () use ($emprestimo) {
            $emprestimo = Emprestimo::whereKey($emprestimo->id)->lockForUpdate()->firstOrFail();

            if ($emprestimo->status === 'Devolvido') {
                throw ValidationException::withMessages([
                    'emprestimo' => 'Este empréstimo já foi devolvido.',
                ]);
            }

            $livro = Livro::whereKey($emprestimo->livro_id)->lockForUpdate()->firstOrFail();

            $emprestimo->update([
                'data_devolucao' => today(),
                'status' => 'Devolvido',
            ]);

            $livro->increment('quantidade');
        });

        return redirect()->route('emprestimos.index')
            ->with('sucesso', 'Devolução registrada com sucesso!');
    }
}
