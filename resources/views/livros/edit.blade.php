@extends('layouts.app')
@section('title', 'Editar livro')
@section('content')
<h1>Editar livro</h1>
<div class="caixa">
    <form method="POST" action="{{ route('livros.update', $livro) }}">
        @csrf
        @method('PUT')
        @include('livros._form')
    </form>
</div>
@endsection
