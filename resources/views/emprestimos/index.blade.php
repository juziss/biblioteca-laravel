@extends('layouts.app')
@section('title', 'Empréstimos')
@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Empréstimos</h1>
    <a class="btn btn-rosa" href="{{ route('emprestimos.create') }}">Novo empréstimo</a>
</div>
<form method="GET" class="row g-2 align-items-center mb-3">
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">Todos os status</option>
            <option value="Em andamento" @selected(request('status') === 'Em andamento')>Em andamento</option>
            <option value="Devolvido" @selected(request('status') === 'Devolvido')>Devolvido</option>
        </select>
    </div>
    <div class="col-auto">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="atrasados" value="1" id="atrasados" @checked(request()->boolean('atrasados'))>
            <label class="form-check-label" for="atrasados">Somente atrasados</label>
        </div>
    </div>
    <div class="col-auto">
        <button class="btn btn-outline-rosa">Filtrar</button>
        <a class="btn btn-link text-secondary" href="{{ route('emprestimos.index') }}">Limpar</a>
    </div>
</form>
<div class="caixa p-0 overflow-hidden">
    <table class="table align-middle">
        <thead>
            <tr><th>Leitor</th><th>Livro</th><th>Empréstimo</th><th>Devolução prevista</th><th>Devolvido em</th><th>Status</th><th class="text-end">Ações</th></tr>
        </thead>
        <tbody>
        @forelse($emprestimos as $emprestimo)
            <tr>
                <td>{{ $emprestimo->leitor->nome }}</td>
                <td>{{ $emprestimo->livro->titulo }}</td>
                <td>{{ $emprestimo->data_emprestimo->format('d/m/Y') }}</td>
                <td>{{ $emprestimo->data_devolucao_prevista->format('d/m/Y') }}</td>
                <td>{{ $emprestimo->data_devolucao?->format('d/m/Y') ?? '-' }}</td>
                <td>
                    @if($emprestimo->status === 'Devolvido')
                        <span class="badge badge-devolvido">Devolvido</span>
                    @elseif($emprestimo->estaAtrasado())
                        <span class="badge badge-atrasado">Atrasado</span>
                    @else
                        <span class="badge badge-andamento">Em andamento</span>
                    @endif
                </td>
                <td class="text-end">
                    @if($emprestimo->status === 'Em andamento')
                        <form method="POST" action="{{ route('emprestimos.devolver', $emprestimo) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-rosa">Devolver</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center py-4">Nenhum empréstimo encontrado.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $emprestimos->links() }}</div>
@endsection
