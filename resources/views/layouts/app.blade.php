<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Biblioteca')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --rosa: #d63384;
            --rosa-escuro: #a61e64;
            --rosa-claro: #fde7f1;
            --rosa-borda: #f5c2da;
        }
        body {
            background-color: #fff6fa;
            color: #4a2a3a;
        }
        .navbar-rosa {
            background-color: var(--rosa);
        }
        .navbar-rosa .navbar-brand,
        .navbar-rosa .nav-link {
            color: #fff;
        }
        .navbar-rosa .nav-link:hover,
        .navbar-rosa .nav-link.active {
            color: #fff;
            text-decoration: underline;
            text-underline-offset: 6px;
        }
        h1 {
            color: var(--rosa-escuro);
            font-size: 1.8rem;
            margin-bottom: 1.2rem;
        }
        .btn-rosa {
            background-color: var(--rosa);
            border-color: var(--rosa);
            color: #fff;
        }
        .btn-rosa:hover,
        .btn-rosa:focus {
            background-color: var(--rosa-escuro);
            border-color: var(--rosa-escuro);
            color: #fff;
        }
        .btn-outline-rosa {
            border-color: var(--rosa);
            color: var(--rosa);
        }
        .btn-outline-rosa:hover {
            background-color: var(--rosa);
            color: #fff;
        }
        .caixa {
            background-color: #fff;
            border: 1px solid var(--rosa-borda);
            border-radius: 12px;
            padding: 1.5rem;
        }
        .table thead th {
            background-color: var(--rosa-claro);
            color: var(--rosa-escuro);
            border-bottom: 2px solid var(--rosa-borda);
        }
        .table {
            margin-bottom: 0;
        }
        .form-control:focus,
        .form-select:focus,
        .form-check-input:focus {
            border-color: var(--rosa);
            box-shadow: 0 0 0 .2rem rgba(214, 51, 132, .2);
        }
        .form-check-input:checked {
            background-color: var(--rosa);
            border-color: var(--rosa);
        }
        .indicador {
            background-color: #fff;
            border: 1px solid var(--rosa-borda);
            border-left: 6px solid var(--rosa);
            border-radius: 12px;
            padding: 1.2rem 1.4rem;
        }
        .indicador h6 {
            color: #8a5a72;
            margin-bottom: .4rem;
        }
        .indicador h2 {
            color: var(--rosa);
            margin: 0;
            font-weight: 700;
        }
        .badge-andamento {
            background-color: var(--rosa-claro);
            color: var(--rosa-escuro);
        }
        .badge-devolvido {
            background-color: #e9e3e6;
            color: #5c4a53;
        }
        .badge-atrasado {
            background-color: #b02a37;
            color: #fff;
        }
        .pagination .page-link {
            color: var(--rosa);
        }
        .pagination .active > .page-link {
            background-color: var(--rosa);
            border-color: var(--rosa);
            color: #fff;
        }
        .alert-success {
            background-color: var(--rosa-claro);
            border-color: var(--rosa-borda);
            color: var(--rosa-escuro);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand navbar-rosa">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Biblioteca</a>
        <div class="navbar-nav">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Painel</a>
            <a class="nav-link {{ request()->routeIs('livros.*') ? 'active' : '' }}" href="{{ route('livros.index') }}">Livros</a>
            <a class="nav-link {{ request()->routeIs('leitores.*') ? 'active' : '' }}" href="{{ route('leitores.index') }}">Leitores</a>
            <a class="nav-link {{ request()->routeIs('emprestimos.*') ? 'active' : '' }}" href="{{ route('emprestimos.index') }}">Empréstimos</a>
        </div>
    </div>
</nav>
<main class="container py-4">
    @if(session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif
    @if(session('erro'))
        <div class="alert alert-danger">{{ session('erro') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Verifique os dados informados:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</main>
</body>
</html>
