<?php

use App\Http\Controllers\{EnounController,UserEnounController,ProdutoEnounController, ServicoEnounController};
use Illuminate\Support\Facades\Route;

Route::get('/',[EnounController::class,'index'])->name('inicio');

Route::get('/login',[UserEnounController::class,'index'])->name('login');

Route::get('/cadastro',[UserEnounController::class,'create'])->name('cadastro');

Route::get('/produtos',[ProdutoEnounController::class,'index'])->name('produtos');

Route::get('/servicos',[ServicoEnounController::class,'index'])->name('servicos');

Route::get('/sobre',[EnounController::class,'sobre'])->name('sobre');

Route::get('/recuperarUser',[UserEnounController::class,'recuperar'] )->name('recuperar');

Route::get('/dashboard',[UserEnounController::class,'dashboard'])->name('dashboard');

Route::get('/carrinho',[UserEnounController::class,'carrinho' ])->name('carrinho');

Route::get('/formProduto', [ProdutoEnounController::class,'create'])->name('formulario.produto');

Route::get('/categoriaForm',[UserEnounController::class,'formCategoria'])->name('formulario.categoria');

Route::post('/formProduto', [ProdutoEnounController::class,'store'])->name('cadastro.produto');

Route::post('/cadastroUser',[UserEnounController::class,'store'])->name('cadastro.userForm');
