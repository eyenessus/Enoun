<?php
namespace App\Repositories\Pay\MercadoPago;


use App\Services\Produto\ProdutoEnounService;
use App\Services\Servico\ServicoEnounService;
use Illuminate\Support\Facades\Auth;

class MercadoPagoEloquentORM implements MercadoPagoInterface
{
    public function __construct(
        protected ProdutoEnounService $serviceProduto,
        protected ServicoEnounService $serviceServico,
    ){}

    public function buscarItensCarrinho() : array
    {
       $produtos = auth()->user()->produtosComCarrinho;
       $servicos = auth()->user()->servicosComCarrinho;
        return [
            'produto' => collect($produtos),
            'servicos' => collect($servicos)
        ];
    }

    public function buscarDadosCliente(): array
    {
        $dados = auth()->user();
        return [$dados];
    }
}