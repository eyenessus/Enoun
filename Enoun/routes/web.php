<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Inicio.inicio');
})->name('inicio');


Route::get('/login', function () {
    return view('Login.login');
})->name('login');

Route::get('/signin', function () {
    return view('Cadastro.cadastro');
})->name('cadastro');

Route::get('/service', function () {
    return view('Servicos.servicos');
})->name('servicos');

Route::get('/contact', function () {
    return view('Contato.contato');
})->name('contato');


Route::fallback(function () {
    return "ERROR, PÁGINA NÃO ENCONTRADA";
});