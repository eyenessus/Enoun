<?php

namespace App\Repositories\Pay\MercadoPago;


use App\Models\Pedido;
use App\Services\Produto\ProdutoEnounService;
use App\Services\Servico\ServicoEnounService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Payment;
use MercadoPago\SDK;

class MercadoPagoEloquentORM implements MercadoPagoInterface
{
    public function __construct(
        protected ProdutoEnounService $serviceProduto,
        protected ServicoEnounService $serviceServico,
    ) {
        SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
    }

    public function buscarItensCarrinho(): array
    {
        $produtos = auth()->user()->produtosComCarrinho;
        $servicos = auth()->user()->servicosComCarrinho;
        return [
            'produto' => collect($produtos),
            'servicos' => collect($servicos)
        ];
    }

    public function buscarDadosCliente(): Collection
    {
        $dados = auth()->user();
        return collect($dados);
    }


    public function notificacoesMercadoPago(Request $request)
    {
        if($request['type'])
        {
            if ($request['data']['id'] || $request['type'] == 'payment') {
                $payment = Payment::find_by_id($request['data']['id']);
                $status = [
                    'approved' => 'PAGAMENTO APROVADO',
                    'pending' => 'AGUARDANDO PAGAMENTO',
                    'in_process' => 'PROCESSANDO',
                    'rejected' => 'PAGAMENTO RECUSADO',
                    'cancelled' => 'PAGAMENTO CANCELADO',
                    'failed' => 'PAGAMENTO ERRADO',
                    'refunded'=> 'PAGAMENTO REEMBOLSADO',
                    'charged_back'=> 'PAGAMENTO ESTORNADO'
                ];
                switch($payment->status)
                {
                    case $payment->status:
                        Pedido::where('id', $request['data']['id'])->orWhere('id',$payment->external_reference)
                        ->update(['status' => $status[$payment->status]]);
                    break;

                    default:
                    Pedido::where('id', $request['data']['id'])->orWhere('id',$payment->external_reference)
                        ->update(['status' => 'Erro desconhecido']);
                    break;
                }; 
            }
            return response('OK',200);
        }
       return response('NOT',400);
    }
}
