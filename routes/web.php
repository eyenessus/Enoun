<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnounController;
use App\Http\Controllers\EnounDeletController;
use App\Http\Controllers\EnounPostController;
use App\Http\Controllers\EnounPutController;


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


//LOGIN E LOGOUTH
Route::get('/signin',[EnounController::class,"create"])->name('cadastro');

//PAGINA INICIAL
Route::get('/',[EnounController::class,"index"])->name('inicio');
Route::get('/search/{id?}', [EnounController::class,'search'])->name('buscar');

//USUARIO
Route::post('/cadastrarUsuario',[EnounPostController::class,'cadastrarUsuario'])->name('inserir');


//CONTATO
Route::get('/contato', [EnounController::class,"contato"])->name('contato');
Route::post('/enviarMensagem', [EnounPostController::class, 'enviarMensagem'])->name('contate');

//SERVICOS
Route::get('/formServicos', [EnounController::class, 'formServico'])->name('RegistrarServico')->middleware('auth');
Route::get('/servicos', [EnounController::class, "servicos"])->name('servicos');
Route::get('/servicos/mostrar/{id}', [EnounController::class,"exibirServico"])->name('showService');
Route::post('/registrarServico',[EnounPostController::class,'registrarServico'])->name('saveservice')->middleware('auth');


//NOTICIAS
Route::get('/formNoticias', [EnounController::class, 'formNoticia'])->name('RegistrarNoticia')->middleware('auth');
Route::get('/resultadoNoticia/{id}', [EnounController::class, 'exbirNoticia']);
Route::post('/registrarNoticia',[EnounPostController::class,'registrarNoticia'])->name('savenoti')->middleware('auth');

//DASHBOARD
Route::get('/dashboard', [EnounController::class, 'dashboard'])->name('dash')->middleware('auth');


//SERVIÇOS DASHBOARD 
Route::get('/formEditServico/{id}', [EnounController::class, 'formEditServico'])->middleware('auth');
Route::get('/exibirServicoDash/{id}', [EnounController::class, 'exibirServicoDash'])->middleware('auth');
Route::delete('/excluirServico/{id}', [EnounDeletController::class, 'deletarServico'])->middleware('auth');
Route::put('/editarServico/{id}', [EnounPutController::class, 'editarServico'])->middleware('auth');

//NOTICIAS DASHBOARD 
Route::get('/visualizarNoticia/{id}', [EnounController::class, 'exibirNoticiaDash'])->middleware('auth');
Route::get('/formEditNoticia/{id}', [EnounController::class, 'formEditNoticia'])->middleware('auth');
Route::put('/editarNoticia/{id}', [EnounPutController::class, 'editarNoticia'])->middleware('auth');
Route::delete('/excluirNoticia/{id}', [EnounDeletController::class, 'deletarNoticia'])->middleware('auth');


//SLIDES DASHBOARD
Route::get('/formSlides',[EnounController::class,'formSlides'])->name('slides')->middleware('auth');
Route::post('/registrarSlide', [EnounPostController::class, 'registroSlide'])->middleware('auth');


//CARRINHO
Route::get('/carrinho', [EnounController::class, 'exibirCarrinho'])->name('verCarrinho')->middleware('auth');
Route::post('/adicionarItemCarrinho/{id}', [EnounPostController::class, 'adicionarAoCarrinho'])->name('adicionar')->middleware('auth');
Route::delete('/removerDoCarrinho/{id}', [EnounDeletController::class, 'removerDoCarrinho'])->middleware('auth');



//PEDIDOS
Route::get('/exibirPedidos', [EnounController::class, 'verPedidos'])->name('pedidos')->middleware('auth');
Route::get('/finalizarPedido', [EnounPostController::class, 'finalizarPedido'])->name('finalizarPedido')->middleware('auth');

