@extends('layouts.app')
@section('title', 'Novo empréstimo')
@section('content')
<h1>Novo empréstimo</h1>
<div class="caixa">
    @if($leitores->isEmpty() || $livros->isEmpty())
        <p class="mb-3">Para registrar um empréstimo é preciso ter pelo menos um leitor cadastrado e um livro com exemplares disponíveis.</p>
        <a class="btn btn-outline-rosa" href="{{ route('emprestimos.index') }}">Voltar</a>
    @else
        <form method="POST" action="{{ route('emprestimos.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="leitor_id">Leitor</label>
                    <select id="leitor_id" name="leitor_id" class="form-select">
                        <option value="">Selecione</option>
                        @foreach($leitores as $leitor)
                            <option value="{{ $leitor->id }}" @selected(old('leitor_id') == $leitor->id)>{{ $leitor->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="livro_id">Livro</label>
                    <select id="livro_id" name="livro_id" class="form-select">
                        <option value="">Selecione</option>
                        @foreach($livros as $livro)
                            <option value="{{ $livro->id }}" @selected(old('livro_id') == $livro->id)>{{ $livro->titulo }} ({{ $livro->quantidade }} disponíveis)</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="data_emprestimo">Data do empréstimo</label>
                    <input id="data_emprestimo" name="data_emprestimo" type="date" class="form-control" value="{{ old('data_emprestimo', today()->format('Y-m-d')) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="data_devolucao_prevista">Devolução prevista</label>
                    <input id="data_devolucao_prevista" name="data_devolucao_prevista" type="date" class="form-control" value="{{ old('data_devolucao_prevista', today()->addDays(7)->format('Y-m-d')) }}">
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-rosa">Registrar empréstimo</button>
                <a class="btn btn-outline-secondary" href="{{ route('emprestimos.index') }}">Cancelar</a>
            </div>
        </form>
    @endif
</div>
@endsection
