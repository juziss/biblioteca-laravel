@extends('layouts.app')
@section('title', 'Painel')
@section('content')
<h1>Painel administrativo</h1>
<div class="row g-3">
    <div class="col-md-3">
        <div class="indicador h-100">
            <h6>Livros cadastrados</h6>
            <h2>{{ $totalLivros }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="indicador h-100">
            <h6>Leitores cadastrados</h6>
            <h2>{{ $totalLeitores }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="indicador h-100">
            <h6>Empréstimos em andamento</h6>
            <h2>{{ $emAndamento }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="indicador h-100">
            <h6>Empréstimos atrasados</h6>
            <h2>{{ $atrasados }}</h2>
        </div>
    </div>
</div>
<div class="caixa mt-4">
    <h5 class="mb-3">Acesso rápido</h5>
    <a class="btn btn-rosa me-2 mb-2" href="{{ route('livros.create') }}">Novo livro</a>
    <a class="btn btn-rosa me-2 mb-2" href="{{ route('leitores.create') }}">Novo leitor</a>
    <a class="btn btn-rosa me-2 mb-2" href="{{ route('emprestimos.create') }}">Novo empréstimo</a>
    <a class="btn btn-outline-rosa mb-2" href="{{ route('emprestimos.index', ['atrasados' => 1]) }}">Ver atrasados</a>
</div>
@endsection
