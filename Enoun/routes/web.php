<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnounController;
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

Route::get('/',[EnounController::class,"Inicio"])->name('inicio');


Route::get('/login', [EnounController::class,'Login'])->name('login');

Route::get('/signin',[EnounController::class,"Cadastro"])->name('cadastro');

Route::get('/service', [EnounController::class,"Servicos"])->name('servicos');
Route::get('/service/show/{id}', [EnounController::class,"MostrarServico"])->name('showService');

Route::get('/contact', [EnounController::class,"Contato"])->name('contato');

Route::get('/search/{id?}', [EnounController::class,'Buscar'])->name('buscar');

Route::post('/insert',[EnounController::class,'Cadastrar'])->name('inserir');

Route::get('/formNoticias', [EnounController::class, 'RNoti'])->name('RegistrarNoticia');
Route::get('/formServicos', [EnounController::class, 'RService'])->name('RegistrarServico');


Route::post('/regnoti',[EnounController::class,'SaveNoticia'])->name('savenoti');

Route::post('/regsave',[EnounController::class,'SaveService'])->name('saveservice');

Route::fallback(function () {
    return "ERROR, PÁGINA NÃO ENCONTRADA";
});