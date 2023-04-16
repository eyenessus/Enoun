<?php

namespace App\Services\Pay\MercadoPago;

use App\Repositories\Pay\MercadoPago\MercadoPagoInterface;
use App\Services\User\UserEnounService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Customer;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;


class MercadoPagoService
{
    public function __construct(
        protected MercadoPagoInterface $repository,
        protected UserEnounService $serviceUser
    ) {
        SDK::initialize();
        SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
        SDK::setIntegratorId('INTEGRATOR_ID');
    }
    public function paymentPreference()
    {
        $preference = new Preference();
        $pagadorInfor = Auth::user();
        $bagItems = [];
        $pedido = $this->repository->buscarItensCarrinho();

        foreach (array_merge($pedido['produto']->toArray(), $pedido['servicos']->toArray()) as $item) {
            $pedidoItem = new Item();
            $pedidoItem->id = $item['id'];
            $pedidoItem->title = $item['nome'];
            $pedidoItem->description = $item['descricao'];
            $pedidoItem->quantity = $item['pivot']['quantidade'];
            $pedidoItem->unit_price = $item['valor'];
            $pedidoItem->category_id = $item['categoria_id'];
            $bagItems[] = $pedidoItem;
        }

        $preference->back_urls = [
            "success" => route('inicio'),
            "failure" => route('inicio'),
            "pending" => route('inicio')
        ];

        $preference->items = $bagItems;
        $preference->description = 'Servicos de informática';
        $preference->notification_url = '';
        $preference->external_reference = "idDoPedido";
        $preference->save();

        $pagador = new Payer();
        $pagador->email = $pagadorInfor->email;
        $pagador->name = $pagadorInfor->nome;
        $pagador->surname = $pagadorInfor->nome;
        $pagador->id = $pagadorInfor->id;
        $pagador->phone = [
            'area_code' => '11',
            'number' => '12345678'
        ];
        $pagador->identification = [
            'type' => 'CPF',
            'number' => '12345678900',
        ];
        $pagador->address = [
            'zip_code' => '',
            'street_name' => '',
            'street_number' => '123',
            'floor' => '8',
            'apartment' => '85',
            'city' => '$cliente->cidade',
            'state' => '',
            'country' => 'BR'
        ];
        $preference->payer = $pagador;
        $this->serviceUser->finalizarPedido();
        return $preference->init_point;
    }

    public function qrCodePix()
    {
        $bagItems = [];
        $payment = new Payment();
        $payment->payment_method_id = "pix";
        $pedido = $this->repository->buscarItensCarrinho();
        foreach (array_merge($pedido['produto']->toArray(), $pedido['servicos']->toArray()) as $item) {
            $pedidoItem = new Item();
            $pedidoItem->id = $item['id'];
            $pedidoItem->title = $item['nome'];
            $pedidoItem->description = $item['descricao'];
            $pedidoItem->quantity = $item['pivot']['quantidade'];
            $pedidoItem->unit_price = $item['valor'];
            $pedidoItem->category_id = $item['categoria_id'];
            $bagItems[] = $pedidoItem;
        }
        $payment->metadata = $bagItems;
        $finalizar = $this->serviceUser->finalizarPedido();
        $payment->transaction_amount =  $finalizar['valorTotal'];
        $payment->payer = [
            "entity_type" => "individual",
            "email" => "exemplo@email.com",
            "identification" => [
                "type" => 'CPF',
                "number" => '92905970030'
            ],
            "first_name" => "Emerson",
            "last_name" => "Sousa"
        ];
        $payment->external_reference = '2323';
        $payment->notification_url = "https://www.google.com";
        $payment->statement_descriptor = "Serviços de informáta";
        if (!$bagItems) {

            return null;
        }
        $payment->save();

        $qrCodePixBase64 = $payment->point_of_interaction->transaction_data->qr_code_base64;
        $copiaEcola = $payment->point_of_interaction->transaction_data->qr_code;
        $total = $payment->transaction_amount;
        return compact('qrCodePixBase64', 'copiaEcola', 'total');
    }
    public function buscarDadosCliente()
    {
        return $this->repository->buscarDadosCliente();
    }
    public function fecharCompra()
    {
        $finalizar = $this->serviceUser->finalizarPedido();
        return $finalizar['valorTotal'];
    }
    public function paymentCartaoCredito(Request $request)
    {
        $payment = new Payment();
        $payment->transaction_amount = (float)$request->input('transactionAmount');
        $payment->token = $request->input('token');
        $payment->description = $request->input('description');
        $payment->installments = (int)$request->input('installments');
        $payment->payment_method_id = $request->input('paymentMethodId');
        $payment->issuer_id = (int)$request->input('issuer');

        $payer = new Payer();
        $payer->email = $request->input('email');
        $payer->identification = [
            "type" => $request->input('identificationType'),
            "number" => $request->input('identificationNumber')
        ];
        $payment->payer = $payer;
        $payment->save();

        $response = [
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        ];
        return $response;
    }
    public function boletoBradesco()
    {
        $finalizar = $this->serviceUser->finalizarPedido();
        if (!$finalizar['valorTotal']) {
            return null;
        }

        $payment = new Payment();
        $cliente = $this->repository->buscarDadosCliente();
        $payment->transaction_amount = (float) $finalizar['valorTotal'];
        $payment->description = "Compra de teste";
        $payment->payer = array(
            "email" => $cliente[0]['email']
        );
        $payment->payment_method_id = "bolbradesco";
        $payment->payer = array(
            "email" => $cliente[0]['email'],
            "first_name" => $cliente[0]['nome'],
            "last_name" => $cliente[0]['nome'],
            "identification" => array(
                "type" => "CPF",
                "number" => "92905970030"
            )
        );
        $payment->save();
        
        $boleto_url = $payment->transaction_details->external_resource_url;
        return $boleto_url;
    }

    public function salvarCartao()
    {
    }


    public function obterTodosCartoes()
    {
    }

    public function obterCartao()
    {
    }

    public function atualizarCartao()
    {
    }


    public function excluirCartao()
    {
    }

    public function criarAssinatura()
    {
    }

    public function criarPlanoAssinatura()
    {
    }

    public function criarCliente(Request  $request)
    {
        $customer = new Customer();
        $customer->email = 'testeone98675645@gmail.com';
        $customer->first_name = 'Emerson';
        $customer->last_name = 'Sousa';
        $customer->phone = array(
            'area_code' => '11',
            'number' => '11992515755'
        );
        $customer->identification = array(
            'type' => 'CPF',
            'number' => '52781012882'
        );
        $customer->address = array(
            'zip_code' => '05878180',
            'street_name' => 'Rua Vanio Mondini',
            'street_number' => 38,
            'neighborhood' => 'Parque independencia',
            'city' => array(
                'name' => 'São Paulo',
                'id' => 'BR-SP-44'
            ),
            'federal_unit' => 'SP',
            'country' => 'BR'
        );

        $customer->save();
    }
}
