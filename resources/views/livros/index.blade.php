@extends('layouts.app')
@section('title', 'Livros')
@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Livros</h1>
    <a class="btn btn-rosa" href="{{ route('livros.create') }}">Novo livro</a>
</div>
<form method="GET" class="row g-2 mb-3">
    <div class="col-md-6">
        <input name="busca" value="{{ $busca }}" class="form-control" placeholder="Título ou autor">
    </div>
    <div class="col-auto">
        <button class="btn btn-outline-rosa">Pesquisar</button>
    </div>
</form>
<div class="caixa p-0 overflow-hidden">
    <table class="table align-middle">
        <thead>
            <tr><th>Título</th><th>Autor</th><th>Editora</th><th>ISBN</th><th>Disponíveis</th><th class="text-end">Ações</th></tr>
        </thead>
        <tbody>
        @forelse($livros as $livro)
            <tr>
                <td>{{ $livro->titulo }}</td>
                <td>{{ $livro->autor }}</td>
                <td>{{ $livro->editora }}</td>
                <td>{{ $livro->isbn }}</td>
                <td>{{ $livro->quantidade }}</td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-rosa" href="{{ route('livros.edit', $livro) }}">Editar</a>
                    <form method="POST" action="{{ route('livros.destroy', $livro) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir este livro?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center py-4">Nenhum livro encontrado.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $livros->links() }}</div>
@endsection
