<?php

namespace App\Repositories\Pay\MercadoPago;


use App\Models\Pedido;
use App\Services\Produto\ProdutoEnounService;
use App\Services\Servico\ServicoEnounService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Payment;

class MercadoPagoEloquentORM implements MercadoPagoInterface
{
    public function __construct(
        protected ProdutoEnounService $serviceProduto,
        protected ServicoEnounService $serviceServico,
    ) {
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

    public function buscarDadosCliente(): array
    {
        $dados = auth()->user();
        return [$dados];
    }
    public function notificacoesMercadoPago(Request $request)
    {
        if (!$request->has('id') || !$request->has('topic')) {
            return response('NOK', 400);
        }

        if ($request->input('topic') == 'payment') {
            $payment = Payment::find_by_id($request->input('id'));
            switch ($payment->status) {
                case 'approved':
                    Pedido::where('id', $payment->external_reference)
                        ->update(['status' => "PAGAMENTO APROVADO"]);
                    break;
                case 'pending':
                    Pedido::where('id', $payment->external_reference)
                        ->update(['status' => "AGUARDANDO PAGAMENTO"]);
                    break;
                case 'in_process':
                    Pedido::where('id', $payment->external_reference)
                        ->update(['status' => "PROCESSANDO"]);
                    break;
                case 'rejected':
                    Pedido::where('id', $payment->external_reference)
                        ->update(['status' => "PAGAMENTO RECUSADO"]);
                    break;
                case 'cancelled':
                    Pedido::where('id', $payment->external_reference)
                        ->update(['status' => "PAGAMENTO CANCELADO"]);
                    break;
                case 'refunded':
                    Pedido::where('id', $payment->external_reference)
                        ->update(['status' => "PAGAMENTO REEMBOLSADO"]);
                    break;
                case 'charged_back':
                    Pedido::where('id', $payment->external_reference)
                        ->update(['status' => "PAGAMENTO ESTORNADO"]);
                    break;
                default:
                    Pedido::where('id', $payment->external_reference)
                        ->update(['status' => "Não reconhecido"]);
                    return response('NOK', 400);
            }

            return response('OK', 200);
        }

        return response('NOK', 400);
    }
}
