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
use MercadoPago\Plan;
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
        $status =  $this->clienteMercadoPago = Customer::search(['email' => $usuarioAuthEncontrado->email]);
        SDK::setClientId($this->clienteMercadoPago[0]->id);
    }
    public function paymentPreference()
    {
        $this->identificacaoUsuario();
        $preference = new Preference();
        $pagadorInfor = $this->usuarioAuth;
        $bagItems = [];
        $pedido = $this->repository->buscarItensCarrinho();
        $finalizarPedido = $this->serviceUser->finalizarPedido();
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
            'zip_code' => $pagadorInfor->endereco->cep,
            'street_name' => $pagadorInfor->endereco->rua,
            'street_number' => $pagadorInfor->endereco->numero,
            'city' => $pagadorInfor->endereco->cidade,
            'state' => $pagadorInfor->endereco->estado,
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
            "first_name" => $this->usuarioAuth->nome,
            "last_name" => $this->usuarioAuth->sobrenome
        ];
        $payment->external_reference = 'Pagamento Pix';
        $payment->notification_url = "https://webhook.site/f5140fda-b70c-4caf-9ae8-bf61210412c1";
        $payment->statement_descriptor = "Serviços de informáta";
        if (!$bagItems) {
            return null;
        }
        $payment->save();
        $finalizar = $this->serviceUser->finalizarPedido($payment->status, $payment->id);
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
        $finalizarPedido = $this->serviceUser->finalizarPedido($payment->status, $payment->id);
        $response = [
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        ];
        return $response;
    }
    public function boletoBradesco()
    {

        $finalizar = $this->serviceUser->valorFinal();
        if (!$finalizar['total']) {
            return null;
        }
        
        $this->identificacaoUsuario();
        $payment = new Payment();
        $payment->transaction_amount = (int) $finalizar['total'];
        $payment->description = "Compra de teste";
        $payment->payment_method_id = "bolbradesco";
        $payment->payer = [
            "email" => $this->usuarioAuth->email,
            "first_name" => $this->usuarioAuth->email,
            "last_name" => $this->usuarioAuth->sobrenome,
            "identification" => [
                "type" => "CPF",
                "number" => "86236798060"
            ]
        ];
        $payment->notification_url = "https://webhook.site/f5140fda-b70c-4caf-9ae8-bf61210412c1";
        $payment->save();
        
        $boleto_url = $payment->transaction_details->external_resource_url;
        $finalizar = $this->serviceUser->finalizarPedido($payment->status, $payment->id);
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
            'name' => $request['cartaoHolder'],
            'identification' => [
                'type' => $request['tipoDocumento'],
                'number' => $request['documento'],
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
        if ($identificacaoCliente->cards == null) {
           return false;
        }
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
            'name' => $request['cartaoHolder'],
            'identification' => [
                'type' => $request['tipoDocumento'],
                'number' => $request['documento'],
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
            return redirect()->route('inicio');
       /*
        $this->identificacaoUsuario();
        $cliente = SDK::getClientId();
        $informacoesCartao = $this->encontrarCartao($request->card);

        $cardToken = new CardToken();
        $cardToken->cardNumber = $request->input('cardNumber');
        $cardToken->securityCode = $request->input('codigo');
        $cardToken->expirationMonth = $request->input('mesValidade');
        $cardToken->expirationYear = $request->input('anoValidade');
        $cardToken->cardholder = (object) [
            'name' => 'Jon Jon',
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
                'number' => '81265168016',
            ],
        ];
        $informacoesCartao->save();
        return true;
        */
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
        $preapproval->preapproval_plan_id = '2c93808486e4d6830186e828e4f002b8';
        $preapproval->back_url = 'https://google.com';
        $preapproval->status = "authorized";
        $preapproval->external_reference = "ok ok";
        $preapproval->card_id = $cartao->id;
        $preapproval->card_token_id = $request['token'];
        $preapproval->reason = "Some reason";
        $preapproval->save();
        dd($preapproval);
    }

    public function criarPlanoAssinatura(Request $request)
    {
        $dados = [
            "reason" => $request["reason"],
            "auto_recurring" => [
                "frequency" => $request["frequency"],
                "frequency_type" => $request["frequency_type"],
                "billing_day" => $request["billing_day"],
                "billing_day_proportional" => $request["billing_day_proportional"],
                "free_trial" => [
                    "frequency" => $request["free_trial_frequency"],
                    "frequency_type" => $request["free_trial_frequency_type"]
                ],
                "transaction_amount" => $request["transaction_amount"],
                "currency_id" => 'BRL'
            ],
            "payment_methods_allowed" => [
                "payment_types" => [
                    ["id" => "credit_card"]
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
        $resposta = $resposta->json();
        if ($resposta['id']) {
            return true;
        }
    }


    public function criarCliente()
    {
        $this->identificacaoUsuario();
        $pagadorInfor = $this->usuarioAuth;
        $customer = new Customer();
        $customer->email = $pagadorInfor->email;
        $customer->first_name = $pagadorInfor->nome;
        $customer->last_name = $pagadorInfor->sobrenome;
        $customer->phone = [
            'area_code' => '11',
            'number' => '11992515755'
        ];
        $customer->identification = [
            'type' => 'CPF',
            'number' => '1234567890'
        ];
        $customer->address = array(
            'zip_code' => $pagadorInfor->endereco->cep,
            'street_name' => $pagadorInfor->endereco->rua,
            'street_number' => $pagadorInfor->endereco->numero,
            'neighborhood' => $pagadorInfor->endereco->bairro,
            'city' => [
                'name' => $pagadorInfor->endereco->cidade,
                'id' => 'BR-SP-44'
            ],
            'federal_unit' => 'SP',
            'country' => 'BR'
        );
        $customer->save();
        return redirect()->route('inicio');
    }

    public function notificacoesMercadoPago(Request $request)
    {
        $this->repository->notificacoesMercadoPago($request);
    }

    public function buscarTodosPlanosDeAssinatura()
    {
        $resposta = Http::withToken(env('MERCADO_PAGO_ACCESS_TOKEN'))
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])->get('https://api.mercadopago.com/preapproval_plan/search');
        return $resposta->json();
    }

    public function buscarTodasAssinaturas()
    {
        $resposta = Http::withToken(env('MERCADO_PAGO_ACCESS_TOKEN'))
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])->get('https://api.mercadopago.com/preapproval/search');
        dd($resposta->json());
    }
}
