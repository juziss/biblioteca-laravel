<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="nome">Nome</label>
        <input id="nome" name="nome" class="form-control" value="{{ old('nome', $leitor->nome ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label" for="cpf">CPF</label>
        <input id="cpf" name="cpf" class="form-control" placeholder="000.000.000-00" value="{{ old('cpf', $leitor->cpf ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label" for="email">E-mail</label>
        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $leitor->email ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label" for="telefone">Telefone</label>
        <input id="telefone" name="telefone" class="form-control" placeholder="(38) 99999-9999" value="{{ old('telefone', $leitor->telefone ?? '') }}">
    </div>
</div>
<div class="mt-4">
    <button class="btn btn-rosa">Salvar</button>
    <a class="btn btn-outline-secondary" href="{{ route('leitores.index') }}">Cancelar</a>
</div>
