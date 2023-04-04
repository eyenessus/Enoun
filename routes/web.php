<?php

use App\Http\Controllers\EnounController;
use Illuminate\Support\Facades\Route;

Route::get('/',[EnounController::class,'index'])->name('inicio');

Route::get('/login',[EnounController::class,'login'])->name('login');

Route::get('/cadastro',[EnounController::class,'create'])->name('cadastro');

Route::get('/produtos',[EnounController::class,'produtos'])->name('produtos');

Route::get('/servicos',[EnounController::class,'servicos'])->name('servicos');

Route::get('/sobre',[EnounController::class,'sobre'])->name('sobre');

Route::get('/recuperar',[EnounController::class,'recuperar'] )->name('recuperar');

Route::get('/dashboard',[EnounController::class,'dashboard'])->name('dashboard');

Route::get('/carrinho',[EnounController::class,'carrinho' ])->name('carrinho');

Route::get('/formProduto', [EnounController::class,'formProduto'])->name('formulario.produto');

Route::post('/formProduto', [EnounController::class,'cadastrarProduto'])->name('cadastro.produto');

Route::post('/cadastro',[EnounController::class,'store'])->name('cadastro'); 
