<?php

use App\Http\Controllers\{EnounController, UserEnounController, ProdutoEnounController, ServicoEnounController};
use Illuminate\Support\Facades\Route;

Route::get('/', [EnounController::class, 'index'])->name('inicio');

Route::get('/login', [UserEnounController::class, 'index'])->name('login');

Route::get('/cadastro', [UserEnounController::class, 'create'])->name('cadastro');

Route::get('/produtos', [ProdutoEnounController::class, 'index'])->name('produtos');

Route::get('/servicos', [ServicoEnounController::class, 'index'])->name('servicos');

Route::get('/sobre', [EnounController::class, 'sobre'])->name('sobre');

Route::get('/recuperarUser', [UserEnounController::class, 'recuperar'])->name('recuperar');

Route::post('/cadastroUser', [UserEnounController::class, 'store'])->name('cadastro.userForm');

Route::post('/login/auth', [UserEnounController::class, 'autenticar'])->name('login.auth');


Route::middleware('auth')->group(function () {
    Route::get('/carrinho', [UserEnounController::class, 'carrinho'])->name('carrinho');
    Route::post('/produto/adicionar/{id}', [ProdutoEnounController::class, 'adicionarPtCarrinho'])->name('adicionar.produto');
    Route::get('/login/logout', [UserEnounController::class, 'sair'])->name('sair');
});

Route::delete('/removerProduto/{id}',[ProdutoEnounController::class, 'removerDoCarrinho'])->name('removerProduto');
Route::post('/decrementarProduto/{id}',[ProdutoEnounController::class, 'decrementarDoCarrinho'])->name('decrementarProduto');



    Route::get('/dashboard', [UserEnounController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/formServico', [ServicoEnounController::class, 'create'])->name('formulario.servico');

    Route::post('/cadastroServico', [ServicoEnounController::class, 'store'])->name('cadastro.servicoForm');

    Route::get('/formProduto', [ProdutoEnounController::class, 'create'])->name('formulario.produto');

    Route::get('/categoriaForm', [UserEnounController::class, 'formCategoria'])->name('formulario.categoria');

    Route::post('/formProduto', [ProdutoEnounController::class, 'store'])->name('cadastro.produto');
