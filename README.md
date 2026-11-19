# Sistema de Gerenciamento de Biblioteca

Aplicação em Laravel para cadastrar livros e leitores, registrar empréstimos e devoluções, controlar os exemplares disponíveis e acompanhar os indicadores em um painel.

## Requisitos

- PHP 8.3 ou superior
- Composer
- MySQL

## Instalação

1. Crie o banco de dados `biblioteca` no MySQL.
2. No terminal, dentro da pasta do projeto, instale as dependências:

```
composer install
```

3. Crie o arquivo de configuração e gere a chave da aplicação:

```
cp .env.example .env
php artisan key:generate
```

No Windows, use `copy .env.example .env` no lugar de `cp`.

4. Abra o arquivo `.env` e informe o usuário e a senha do MySQL em `DB_USERNAME` e `DB_PASSWORD`.
5. Crie as tabelas. O parâmetro `--seed` cadastra alguns livros, leitores e empréstimos de exemplo:

```
php artisan migrate --seed
```

6. Inicie o servidor e acesse o endereço exibido (normalmente http://127.0.0.1:8000):

```
php artisan serve
```

## Funcionalidades

- Painel com total de livros, total de leitores, empréstimos em andamento e empréstimos atrasados.
- Cadastro, edição, exclusão e pesquisa de livros (por título ou autor).
- Cadastro, edição, exclusão e pesquisa de leitores (por nome).
- Registro de empréstimos com baixa no estoque, dentro de uma transação.
- Registro de devolução com retorno ao estoque e bloqueio de devolução duplicada.
- Filtros de empréstimos por status e somente atrasados.
- Bloqueio da exclusão de livros e leitores que possuem empréstimos.
