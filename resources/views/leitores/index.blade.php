@extends('layouts.app')
@section('title', 'Leitores')
@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Leitores</h1>
    <a class="btn btn-rosa" href="{{ route('leitores.create') }}">Novo leitor</a>
</div>
<form method="GET" class="row g-2 mb-3">
    <div class="col-md-6">
        <input name="busca" value="{{ $busca }}" class="form-control" placeholder="Nome do leitor">
    </div>
    <div class="col-auto">
        <button class="btn btn-outline-rosa">Pesquisar</button>
    </div>
</form>
<div class="caixa p-0 overflow-hidden">
    <table class="table align-middle">
        <thead>
            <tr><th>Nome</th><th>CPF</th><th>E-mail</th><th>Telefone</th><th class="text-end">Ações</th></tr>
        </thead>
        <tbody>
        @forelse($leitores as $leitor)
            <tr>
                <td>{{ $leitor->nome }}</td>
                <td>{{ $leitor->cpf }}</td>
                <td>{{ $leitor->email }}</td>
                <td>{{ $leitor->telefone }}</td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-rosa" href="{{ route('leitores.edit', $leitor) }}">Editar</a>
                    <form method="POST" action="{{ route('leitores.destroy', $leitor) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir este leitor?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center py-4">Nenhum leitor encontrado.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $leitores->links() }}</div>
@endsection
