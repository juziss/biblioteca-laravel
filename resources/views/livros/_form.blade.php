<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="titulo">Título</label>
        <input id="titulo" name="titulo" class="form-control" value="{{ old('titulo', $livro->titulo ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label" for="autor">Autor</label>
        <input id="autor" name="autor" class="form-control" value="{{ old('autor', $livro->autor ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label" for="editora">Editora</label>
        <input id="editora" name="editora" class="form-control" value="{{ old('editora', $livro->editora ?? '') }}">
    </div>
    <div class="col-md-2">
        <label class="form-label" for="ano_publicacao">Ano</label>
        <input id="ano_publicacao" name="ano_publicacao" type="number" class="form-control" value="{{ old('ano_publicacao', $livro->ano_publicacao ?? '') }}">
    </div>
    <div class="col-md-2">
        <label class="form-label" for="isbn">ISBN</label>
        <input id="isbn" name="isbn" class="form-control" value="{{ old('isbn', $livro->isbn ?? '') }}">
    </div>
    <div class="col-md-2">
        <label class="form-label" for="quantidade">Quantidade</label>
        <input id="quantidade" name="quantidade" type="number" min="0" class="form-control" value="{{ old('quantidade', $livro->quantidade ?? 1) }}">
    </div>
</div>
<div class="mt-4">
    <button class="btn btn-rosa">Salvar</button>
    <a class="btn btn-outline-secondary" href="{{ route('livros.index') }}">Cancelar</a>
</div>
