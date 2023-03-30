<?php

use App\Http\Controllers\EnounController;
use Illuminate\Support\Facades\Route;

Route::get('/',[EnounController::class,'index']);

Route::get('/login',[EnounController::class,'login']);

Route::get('/cadastro',[EnounController::class,'cadastro']);

Route::get('/produtos',[EnounController::class,'produtos']);

Route::get('/servicos',[EnounController::class,'servicos']);

Route::get('/sobre',[EnounController::class,'sobre']);  

Route::post('/cadastro',[EnounController::class,'store'])->name('cadastro'); 

Route::get('/recuperar',[EnounController::class,'recuperar'] );

Route::get('/dashboard',[EnounController::class,'dashboard']);

Route::get('/carrinho',[EnounController::class,'carrinho' ]);