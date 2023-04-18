<?php

use App\Http\Controllers\{EnounController, UserEnounController, ProdutoEnounController, ServicoEnounController};
use App\Http\Controllers\Pay\MercadoPagoController;
use App\Http\Controllers\Pay\PagseguroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EnounController::class, 'index'])->name('inicio');


Route::prefix('home')->group(function () {
    Route::get('/sobre', [EnounController::class, 'sobre'])->name('sobre');
});

Route::middleware('auth')->group(function () {
    Route::get('/carrinho', [UserEnounController::class, 'carrinho'])->name('carrinho.index');
    Route::post('/produto/{produto}/add', [ProdutoEnounController::class, 'adicionarPtCarrinho'])->name('produto.add.store');
    Route::delete('/produto/{produto}/delete', [ProdutoEnounController::class, 'removerDoCarrinho'])->name('produto.delete.destroy');
    Route::post('/produto/{produto}/remove', [ProdutoEnounController::class, 'decrementarDoCarrinho'])->name('produto.remove.store');
    Route::post('/servico/{servico}/add', [ServicoEnounController::class, 'adicionarSvCarrinho'])->name('servico.add.store');
    Route::delete('/servico/{servico}/delete', [ServicoEnounController::class, 'removerDoCarrinho'])->name('servico.delete.destroy');
    Route::post('/servico/{servico}/remove', [ServicoEnounController::class, 'decrementarDoCarrinho'])->name('servico.remove.store');
    Route::get('/login/logout', [UserEnounController::class, 'sair'])->name('sair');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [UserEnounController::class, 'dashboard'])->name('dashboard');
    Route::get('/servico/create', [ServicoEnounController::class, 'create'])->name('servico.create');
    Route::post('/servico', [ServicoEnounController::class, 'store'])->name('servico.store');
    Route::get('/produto/create', [ProdutoEnounController::class, 'create'])->name('produto.create');
    Route::post('/produto', [ProdutoEnounController::class, 'store'])->name('produto.store');
    Route::get('/categoria/create', [UserEnounController::class, 'formCategoria'])->name('categoria.create');
    Route::get('/produto/{produto}/edit', [ProdutoEnounController::class, 'edit'])->name('produto.edit');
    Route::put('/produto/{produto}', [ProdutoEnounController::class, 'update'])->name('produto.update');
    Route::delete('/produto/{produto}', [ProdutoEnounController::class, 'destroy'])->name('produto.destroy');
    Route::get('/servico/{servico}/edit', [ServicoEnounController::class, 'edit'])->name('servico.edit');
    Route::put('/servico/{servico}', [ServicoEnounController::class, 'update'])->name('servico.update');
    Route::delete('/servico/{servico}', [ServicoEnounController::class, 'destroy'])->name('servico.destroy');
});

Route::prefix('user')->middleware('guest')->group(function () {
    Route::get('/recovery', [UserEnounController::class, 'recuperar'])->name('user.recovery');
    Route::post('/user', [UserEnounController::class, 'store'])->name('user.store');
    Route::get('/create', [UserEnounController::class, 'create'])->name('user.create');
    Route::get('/login', [UserEnounController::class, 'index'])->name('login');
    Route::post('/login/auth', [UserEnounController::class, 'autenticar'])->name('login.auth');
});

Route::prefix('servicos')->group(
    function () {
        Route::get('/', [ServicoEnounController::class, 'index'])->name('servicos.index');
        Route::get('/{servico}', [ServicoEnounController::class, 'show'])->name('servico.show');
    }
);

Route::prefix('produtos')->group(
    function () {
        Route::get('/{produto}', [ProdutoEnounController::class, 'show'])->name('produto.show');
        Route::get('/', [ProdutoEnounController::class, 'index'])->name('produtos.index');
    }
);

Route::fallback(function () {
    return view('fallback');
});

Route::prefix('mercadoPagoPay')->middleware('auth')->group(function(){
    Route::get('/', [MercadoPagoController::class, 'index'])->name('mercadoPago');
    Route::get('/credito', [MercadoPagoController::class, 'cartaoPagamento'])->name('mercadoPagoCredito');
    Route::get('/pix', [MercadoPagoController::class, 'teste'])->name('mercadoPagoPix');
    Route::get('/boleto', [MercadoPagoController::class, 'boleto'])->name('mercadoPagoBoleto');
    Route::post('/creditoPost',[MercadoPagoController::class,'store'])->name('mercadoPago.credito.store');
    Route::post('/card', [MercadoPagoController::class,'salvarCartao'])->name('salvarCartao');
    Route::get('/card/create',[MercadoPagoController::class,'formSalvarCartao']);
    Route::delete('/card/{card}',[MercadoPagoController::class,'destroy'])->name('apagarCartao');
    Route::get('/card/myall',[MercadoPagoController::class,'obterTodosCartoes'])->name('todosCartoes');
});

Route::post('/editarCartao/{cartao}',[MercadoPagoController::class,'atualizarCartao'])->name('editarCartao');
Route::put('/atualizarCartao/{card}',[MercadoPagoController::class,'update'])->name('atualizarCard');

Route::get('/pagseguri',[PagseguroController::class,'index']);
Route::post('/pagamentoPagSe',[PagseguroController::class,'cartaoCredito'])->name('pagamentoCartaoPag');