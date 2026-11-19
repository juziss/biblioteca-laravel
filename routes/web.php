<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('livros', LivroController::class)
    ->except(['show'])
    ->parameters(['livros' => 'livro']);
