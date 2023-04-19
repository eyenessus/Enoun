<?php

namespace App\Repositories\Pay\MercadoPago;


use App\Models\Pedido;
use App\Services\Produto\ProdutoEnounService;
use App\Services\Servico\ServicoEnounService;
use Illuminate\Http\Request;
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

    public function buscarDadosCliente(): array
    {
        $dados = auth()->user();
        return [$dados];
    }


    public function notificacoesMercadoPago(Request $request)
    {
        if($request['type'])
        {
            if ($request['data']['id'] || $request['type'] == 'payment') {
                $payment = Payment::find_by_id($request['data']['id']);
                switch ($payment->status) {
                    case 'approved':
                        Pedido::where('id', $request['data']['id'])->orWhere('id',$payment->external_reference)
                            ->update(['status' => "PAGAMENTO APROVADO"]);
                        break;
                    case 'pending':
                        Pedido::where('id', $request['data']['id'])->orWhere('id',$payment->external_reference)
                            ->update(['status' => "AGUARDANDO PAGAMENTO"]);
                        break;
                    case 'in_process':
                        Pedido::where('id', $request['data']['id'])->orWhere('id',$payment->external_reference)
                            ->update(['status' => "PROCESSANDO"]);
                        break;
                    case 'rejected':
                        Pedido::where('id', $request['data']['id'])->orWhere('id',$payment->external_reference)
                            ->update(['status' => "PAGAMENTO RECUSADO"]);
                        break;
                    case 'cancelled':
                        Pedido::where('id', $request['data']['id'])->orWhere('id',$payment->external_reference)
                            ->update(['status' => "PAGAMENTO CANCELADO"]);
                        break;
                    case 'refunded':
                        Pedido::where('id', $request['data']['id'])->orWhere('id',$payment->external_reference)
                            ->update(['status' => "PAGAMENTO REEMBOLSADO"]);
                        break;
                    case 'charged_back':
                        Pedido::where('id', $request['data']['id'])->orWhere('id',$payment->external_reference)
                            ->update(['status' => "PAGAMENTO ESTORNADO"]);
                        break;
                    default:
                        Pedido::where('id', $request['data']['id'])->orWhere('id',$payment->external_reference)
                            ->update(['status' => "Não reconhecido"]);
                }
            }
            return response('OK',200);
        }
       return response('NOT',400);
    }
}
