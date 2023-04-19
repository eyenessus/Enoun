<?php

namespace App\Services\Pay\MercadoPago;

use App\Models\User;
use App\Repositories\Pay\MercadoPago\MercadoPagoInterface;
use App\Services\User\UserEnounService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use MercadoPago\Card;
use MercadoPago\CardToken;
use MercadoPago\Customer;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preapproval;
use MercadoPago\Preference;
use MercadoPago\SDK;

class MercadoPagoService
{
    private $usuarioAuth;
    private $clienteMercadoPago;
    public function __construct(
        protected MercadoPagoInterface $repository,
        protected UserEnounService $serviceUser
    ) {
        SDK::initialize();
        SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
        SDK::setPublicKey(env('MERCADO_PAGO_PUBLIC_KEY'));
        SDK::setIntegratorId('INTEGRATOR_ID');
    }
    public function identificacaoUsuario()
    {
        $usuarioAuthEncontrado = $this->usuarioAuth = User::findOrFail(Auth::id());
        $this->clienteMercadoPago = Customer::search(['email' => $usuarioAuthEncontrado->email]);
        SDK::setClientId($this->clienteMercadoPago[0]->id);
    }
    public function paymentPreference()
    {
        $this->identificacaoUsuario();
        $preference = new Preference();
        $pagadorInfor = $this->usuarioAuth;
        $bagItems = [];
        $pedido = $this->repository->buscarItensCarrinho();
        $finalizarPedido =$this->serviceUser->finalizarPedido();
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
        $preference->notification_url = 'https://webhook.site/f5140fda-b70c-4caf-9ae8-bf61210412c1';
        $preference->external_reference = $finalizarPedido['id'];
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
            'city' => 'cidade',
            'state' => '',
            'country' => 'BR'
        ];
        $preference->payer = $pagador;
        return $preference->init_point;
    }

    public function qrCodePix()
    {
        $this->identificacaoUsuario();
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
        $finalizar = $this->serviceUser->valorFinal();
        $payment->transaction_amount =  $finalizar['total'];
        
        $payment->payer = [
            "entity_type" => "individual",
            "email" => $this->usuarioAuth->email,
            "identification" => [
                "type" => 'CPF',
                "number" => '92905970030'
            ],
            "first_name" => "Emerson",
            "last_name" => "Sousa"
        ];
        $payment->external_reference = 'Pagamento Pix';
        $payment->notification_url = "https://webhook.site/f5140fda-b70c-4caf-9ae8-bf61210412c1";
        $payment->statement_descriptor = "Serviços de informáta";
        if (!$bagItems) {
            return null;
        }
        $payment->save();
        $finalizar= $this->serviceUser->finalizarPedido($payment->status,$payment->id);
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
        $id = (int)$response['id'];
        $finalizarPedido = $this->serviceUser->finalizarPedido($payment->status,$id);
        return $response;
    }
    public function boletoBradesco()
    {
        $finalizar = $this->serviceUser->valorFinal();
        if (!$finalizar['total']) {
            return null;
        }

        $payment = new Payment();
        $cliente = $this->repository->buscarDadosCliente();
        $payment->transaction_amount = (float) $finalizar['total'];
        $payment->description = "Compra de teste";
        $payment->payment_method_id = "bolbradesco";
        $payment->payer = [
            "email" => 'teste@gmail.com',
            "first_name" => 'emerson',
            "last_name" => 'sousa',
            "identification" => [
                "type" => "CPF",
                "number" => "86236798060"
            ]
        ];
        $payment->notification_url = "https://webhook.site/f5140fda-b70c-4caf-9ae8-bf61210412c1";
        $payment->save();
        
        $boleto_url = $payment->transaction_details->external_resource_url;
        $finalizar = $this->serviceUser->finalizarPedido($payment->status,$payment->id);
        return $boleto_url;
    }

    public function salvarCartao(Request $request)
    {
        $this->identificacaoUsuario();
        $cardToken = new CardToken();
        $cardToken->cardNumber = $request['cardNumber'];
        $cardToken->securityCode = $request['codigo'];
        $cardToken->expirationMonth = $request['mesValidade'];
        $cardToken->expirationYear = $request['anoValidade'];
        $cardToken->cardholder = (object) [
            'name' => 'John Doe',
            'identification' => [
                'type' => 'CPF',
                'number' => '77703599026',
            ],
        ];
        $cardToken->public_key = SDK::getPublicKey();
        $cardToken->save();

        $card = new Card();
        $card->token = $cardToken->id;
        $card->customer_id = SDK::getClientId();
        $card->payment_method = ["id" => "credit_card"];
        $card->save();

        if (!$card->id) {
            return null;
        }
        return true;
    }

    public function obterTodosCartoes()
    {
        $this->identificacaoUsuario();
        $cliente = SDK::getClientId();
        $identificacaoCliente = Customer::find_by_id($cliente);
        return $identificacaoCliente->cards;
    }
    public function gerarCardToken(Request $request)
    {
        $cardToken = new CardToken();
        $cardToken->cardNumber = $request['cardNumber'];
        $cardToken->securityCode = $request['codigo'];
        $cardToken->expirationMonth = $request['mesValidade'];
        $cardToken->expirationYear = $request['anoValidade'];
        $cardToken->cardholder = (object) [
            'name' => 'John Doe',
            'identification' => [
                'type' => 'CPF',
                'number' => '69995775018',
            ],
        ];
        $cardToken->public_key = SDK::getPublicKey();
        $cardToken->save();
        return $cardToken->id;
    }

    public function encontrarCartao(string $id)
    {
        $this->identificacaoUsuario();
        $cliente = SDK::getClientId();
        $idClient = Customer::find_by_id($cliente);
        $cartao = $idClient->cards;
        foreach ($cartao as $cartoes) {
            if ($cartoes->id == $id) {
                return $cartoes;
            }
        }
    }

    public function atualizarCartao(Request $request)
    {
        $this->identificacaoUsuario();
        $cliente = SDK::getClientId();
        $informacoesCartao = $this->encontrarCartao($request->card);

        $cardToken = new CardToken();
        $cardToken->cardNumber = $request->input('cardNumber');
        $cardToken->securityCode = $request->input('codigo');
        $cardToken->expirationMonth = $request->input('mesValidade');
        $cardToken->expirationYear = $request->input('anoValidade');
        $cardToken->cardholder = (object) [
            'name' => 'John Doe',
            'identification' => [
                'type' => 'CPF',
                'number' => '69995775018',
            ],
        ];
        $cardToken->public_key = SDK::getPublicKey();
        $cardToken->save();

        $informacoesCartao->customer_id = $cliente;
        $informacoesCartao->token = $cardToken->id;
        $informacoesCartao->expiration_month = $request->input('novoMesValidade');
        $informacoesCartao->expiration_year = $request->input('novoAnoValidade');
        $informacoesCartao->cardholder = (object) [
            'name' => 'John Doe',
            'identification' => [
                'type' => 'CPF',
                'number' => '52781012882',
            ],
        ];
        $informacoesCartao->save();
        dd($informacoesCartao);
        return true;
    }

    public function excluirCartao(string $id)
    {
        $this->identificacaoUsuario();
        $cliente = SDK::getClientId();
        $idClient = Customer::find_by_id($cliente);
        $cartao = $idClient->cards;
        foreach ($cartao as $cartoes) {
            if ($cartoes->id == $id) {
                $card = new Card();
                $card->id = $id;
                $card->customer_id = $cliente;
                $card->delete();
                return true;
            }
        }
        return false;
    }

    public function criarAssinatura(Request $request)
    {
        $this->identificacaoUsuario();
        $cartao = new Card();
        $cartao->customer_id = SDK::getClientId();
        $cartao->token = $request['token'];
        $cartao->save();
      
        $preapproval = new Preapproval();
        $preapproval->payer_email = $this->usuarioAuth->email;
        $preapproval->preapproval_plan_id = null; 
        $preapproval->back_url = 'https://google.com';
        $preapproval->auto_recurring = [
            "frequency" => 1,
            "frequency_type" => "months",
            "transaction_amount" => 500,
            "currency_id" => "BRL",
            "repetitions" => 12
        ];
        $preapproval->status = "authorized";
        $preapproval->external_reference = "ok ok";
        $preapproval->card_id = $cartao->id;
        $preapproval->card_token_id = $request['token'];
        $preapproval->reason = "Some reason";
        $preapproval->save();
        dd($preapproval);
    }

    public function criarPlanoAssinatura()
    {
        $dados = [
            "reason" => "Enoun teste",
            "auto_recurring" => [
                "frequency" => 1,
                "frequency_type" => "months",
                "billing_day" => 10,
                "billing_day_proportional" => true,
                "free_trial" => [
                    "frequency" => 1,
                    "frequency_type" => "months"
                ],
                "transaction_amount" => 700,
                "currency_id" => "BRL"
            ],
            "payment_methods_allowed" => [
                "payment_types" => [
                    ['id'=> 'credit_card']
                ],
                "payment_methods" => [
                    ["id" => "pix"],
                    ["id" => "bolbradesco"]
                ]
            ],
            "back_url" => route('meusPedidos')
        ];
        $resposta = Http::withToken(env('MERCADO_PAGO_ACCESS_TOKEN'))
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post('https://api.mercadopago.com/preapproval_plan', $dados);

        return $resposta->json();
     
    }

    public function criarCliente(Request  $request)
    {
       // $this->identificacaoUsuario();
        $customer = new Customer();
        $customer->email = 'test_user_1183031487@testuser.com';
        $customer->first_name = 'Emerson';
        $customer->last_name = 'Sousa';
        $customer->phone = array(
            'area_code' => '11',
            'number' => '11992515755'
        );
        $customer->identification = array(
            'type' => 'CPF',
            'number' => '1234567890'
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

    public function notificacoesMercadoPago(Request $request)
    {
        $this->repository->notificacoesMercadoPago($request);
    }
}
