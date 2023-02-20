<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnounController;
use App\Http\Controllers\EnounDeletController;
use App\Http\Controllers\EnounPostController;
use App\Http\Controllers\EnounPutController;

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





//GETS
Route::get('/',[EnounController::class,"index"])->name('inicio');

Route::get('/signin',[EnounController::class,"create"])->name('cadastro');

Route::get('/servicos', [EnounController::class, "servicos"])->name('servicos');

Route::get('/servicos/mostrar/{id}', [EnounController::class,"exibirServico"])->name('showService');

Route::get('/contato', [EnounController::class,"contato"])->name('contato');

Route::get('/search/{id?}', [EnounController::class,'search'])->name('buscar');

Route::get('/formNoticias', [EnounController::class, 'formNoticia'])->name('RegistrarNoticia')->middleware('auth');

Route::get('/formServicos', [EnounController::class, 'exibirServico'])->name('RegistrarServico')->middleware('auth');

Route::get('/resultadoNoticia/{id}', [EnounController::class, 'exbirNoticia']);


//POSTS
Route::post('/registrarServico',[EnounPostController::class,'registrarServico'])->name('saveservice');
Route::post('/registrarNoticia',[EnounPostController::class,'registrarNoticia'])->name('savenoti');
Route::post('/cadastrarUsuario',[EnounPostController::class,'cadastrarUsuario'])->name('inserir');
Route::post('/enviarMensagem', [EnounPostController::class, 'enviarMensagem'])->name('contate');

//SERVIÇOS DASHBOARD 
Route::delete('/excluirServico/{id}', [EnounDeletController::class, 'deletarServico']);

Route::put('/editarServico/{id}', [EnounPutController::class, 'editarServico']);

Route::get('/formEditServico/{id}', [EnounController::class, 'formEditServico']);

Route::get('/exibirServicoDash/{id}', [EnounController::class, 'exibirServicoDash']);

//NOTICIAS DASHBOARD 
Route::get('/visualizarNoticia/{id}', [EnounController::class, 'exibirNoticiaDash']);

Route::get('/formEditNoticia/{id}', [EnounController::class, 'formEditNoticia']);

Route::delete('/excluirNoticia/{id}', [EnounDeletController::class, 'deletarNoticia']);

Route::put('/editarNoticia/{id}', [EnounPutController::class, 'editarNoticia']);

Route::get('/carrinho', [EnounController::class, 'exibirCarrinho'])->name('verCarrinho')->middleware('auth');

Route::post('/adicionarItemCarrinho/{id}', [EnounPostController::class, 'adicionarAoCarrinho'])->middleware('auth');

Route::delete('/removerDoCarrinho/{id}', [EnounDeletController::class, 'removerDoCarrinho']);

Route::get('/exibirPedidos', [EnounController::class, 'verPedidos'])->name('pedidos')->middleware('auth');

Route::get('/finalizarPedido', [EnounPostController::class, 'finalizarPedido'])->name('finalizarp');

Route::get('/formSlides',[EnounController::class,'formSlides'])->name('slides');

Route::post('/registrarSlide', [EnounPostController::class, 'registroSlide']);

//FALLBACKS
Route::fallback(function () {
    return "ERROR, PÁGINA NÃO ENCONTRADA";
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/dashboard', [EnounController::class, 'dashboard'])->name('dash')->middleware('auth');