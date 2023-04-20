<?php

use App\Http\Controllers\{EnounController, UserEnounController, ProdutoEnounController, ServicoEnounController};
use App\Http\Controllers\Pay\MercadoPagoController;
use App\Http\Controllers\Pay\PagseguroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EnounController::class, 'index'])->name('inicio');


Route::prefix('/home')->group(function () {
    Route::get('/sobre', [EnounController::class, 'sobre'])->name('sobre');
    Route::get('/pedidos', [UserEnounController::class, 'meusPedidos'])->name('meusPedidos');
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
    Route::get('/identidade', [UserEnounController::class, 'formcadastrarIdentidade'])->name('identidade');
    Route::get('/endereco', [UserEnounController::class, 'formEndereco'])->name('endereco');
    Route::post('/identidade', [UserEnounController::class, 'identidade'])->name('identidade.store');
    Route::post('/endereco', [UserEnounController::class, 'endereco'])->name('endereco.store');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/gerenciar/todos/users', [UserEnounController::class, 'verTodosUsuarios'])->name('verTodosUsuarios');
    Route::get('/gerenciar/todos/produtos', [UserEnounController::class, 'verTodosProdutos'])->name('verTodosProdutos');
    Route::get('/gerenciar/todos/servicos', [UserEnounController::class, 'verTodosServicos'])->name('verTodosServicos');
    Route::get('/gerenciar/todos/admin', [UserEnounController::class, 'verTodosAdmins'])->name('verTodosAdmins');
    Route::get('/dashboard', [UserEnounController::class, 'dashboard'])->name('dashboard');
    Route::get('/servico/create', [ServicoEnounController::class, 'create'])->name('servico.create');
    Route::post('/servico', [ServicoEnounController::class, 'store'])->name('servico.store');
    Route::get('/produto/create', [ProdutoEnounController::class, 'create'])->name('produto.create');
    Route::post('/produto', [ProdutoEnounController::class, 'store'])->name('produto.store');
    Route::get('/categoria/create', [UserEnounController::class, 'formCategoria'])->name('categoria.create');
    Route::post('/categoria', [UserEnounController::class, 'salvarCategoria'])->name('categoria.store');
    Route::get('/categoria/all', [UserEnounController::class, 'todasCategoria'])->name('categoria.index');
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


Route::prefix('mercadoPagoPay')->middleware('auth')->group(function () {
    Route::get('/', [MercadoPagoController::class, 'index'])->name('mercadoPago');
    Route::get('/credito', [MercadoPagoController::class, 'cartaoPagamento'])->name('mercadoPagoCredito');
    Route::get('/pix', [MercadoPagoController::class, 'pix'])->name('mercadoPagoPix');
    Route::get('/boleto', [MercadoPagoController::class, 'boleto'])->name('mercadoPagoBoleto');
    Route::post('/creditoPost', [MercadoPagoController::class, 'store'])->name('mercadoPago.credito.store');
    Route::post('/card', [MercadoPagoController::class, 'salvarCartao'])->name('salvarCartao');
    Route::get('/card/create', [MercadoPagoController::class, 'formSalvarCartao']);
    Route::delete('/card/{card}', [MercadoPagoController::class, 'destroy'])->name('apagarCartao');
    Route::get('/card/myall', [MercadoPagoController::class, 'obterTodosCartoes'])->name('meusCartoes');
    Route::post('/editarCartao/{cartao}', [MercadoPagoController::class, 'atualizarCartao'])->name('editarCartao');
    Route::put('/atualizarCartao/{card}', [MercadoPagoController::class, 'update'])->name('atualizarCard');
    Route::post('/cliente/mp', [MercadoPagoController::class, 'criarCliente'])->name('criarClienteMP');
    Route::post('/notifications/mp', [MercadoPagoController::class, 'receberNotificacoes']);
    Route::post('/planoDeAssinatura/mp', [MercadoPagoController::class, 'criarPlanoAssinatura'])->name('planoDeAssinaturaMP');
    Route::get('/plano/assinatura', [MercadoPagoController::class, 'formularioPlanoAssinatura'])->name('formularioPlanoAssinatura');
    Route::get('/gerenciar/todos/assinaturas', [MercadoPagoController::class, 'verTodasAssinaturas'])->name('verTodasAssinaturas');
    Route::get('/planos/mp', [MercadoPagoController::class, 'verTodosPlanosDeAssinatura'])->name('verPlanosAssinatura');
});


Route::post('/assinatura/mp', [MercadoPagoController::class, 'criarAssinatura'])->name('assinaturaMP');
Route::get('/formAssin', [MercadoPagoController::class, 'formAssinatura'])->name('formularioDeAssinatura');

Route::prefix('pagSeguro')->middleware('auth')->group(function () {
    Route::get('/pagSeguroCartao', [PagseguroController::class, 'index'])->name('pagSeguro');
    Route::post('/pagamentoPagSe', [PagseguroController::class, 'cartaoCredito'])->name('pagamentoCartaoPag');
    Route::get('/boletoPagSeguro', [PagseguroController::class, 'boleto'])->name('pagSeguroBoleto');
    Route::get('/pixPagSeguro', [PagseguroController::class, 'pix'])->name('pagSeguroPix');
    Route::get('/assinaturaRecorrente', [PagseguroController::class, 'assinaturaDeRecorrenciaInital'])->name('assinaturaPG');
    Route::get('/assinaturaRecorrenteSub', [PagseguroController::class, 'assinaturaDeRecorrenciaSubsequente'])->name('planoDeAssinaturaPG');
   
});
Route::post('/notifications/pag', [PagseguroController::class, 'receberNotificacoes']);
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
