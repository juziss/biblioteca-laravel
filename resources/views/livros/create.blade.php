@extends('layouts.app')
@section('title', 'Novo livro')
@section('content')
<h1>Novo livro</h1>
<div class="caixa">
    <form method="POST" action="{{ route('livros.store') }}">
        @csrf
        @include('livros._form')
    </form>
</div>
@endsection
