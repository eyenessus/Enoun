<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MercadoPago\Card;
use MercadoPago\CardToken;
use MercadoPago\Customer;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preapproval;
use MercadoPago\Preference;
use MercadoPago\SDK;
use MercadoPago\Payment;
use Symfony\Component\Console\Input\Input;

class MercadoPagoController extends Controller
{
    public function __construct()
    {
        SDK::initialize();
        SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
        SDK::setPublicKey(env('MERCADO_PAGO_PUBLIC_KEY'));
        SDK::setIntegratorId('INTEGRATOR_ID');
    }
    public function criarPagamento($itemsCar, $cliente, $npedido)
    {

        // Crie uma nova preferência
        $preference = new Preference();
        // Configure os itens que serão incluídos na preferência
        $items = [];

        foreach ($itemsCar as $servico) {

            $item = new Item();
            $item->id = $servico['id'];
            $item->title = $servico['nome'];
            $item->description = $servico['descricao'];
            $item->quantity = $servico->pivot['quantidade'];
            $item->unit_price = $servico['preco'];
            $item->category_id = $servico['categoria'];
            $items[] = $item;
        }
        $preference->items = $items;


        // Configure o pagador da preferência
        $payer = new Payer();

        $payer->email = $cliente->email;
        $payer->name = $cliente->nome;
        $payer->surname = $cliente->nome;
        $payer->phone = [
            'area_code' => '11',
            'number' => '12345678'
        ];
        $payer->identification = [
            'type' => 'CPF',
            'number' => '12345678900',
        ];
        $payer->address = [
            'zip_code' => $cliente->cep,
            'street_name' => $cliente->rua,
            'street_number' => '123',
            'floor' => '8',
            'apartment' => '85',
            'city' => $cliente->cidade,
            'state' => $cliente->estado,
            'country' => 'BR'
        ];
        $preference->external_reference = $npedido->id;
        $preference->payer = $payer;


        // Configure as URLs de retorno
        $preference->back_urls = array(
            "success" => route('inicio'),
            "failure" => route('inicio'),
            "pending" => route('inicio')
        );

        $preference->description = 'Servicos de informática';

        $preference->notification_url = '';

        // Salve a preferência
        $preference->save();
        dd($preference);

        // Redirecione o usuário para a página de pagamento do Mercado Pago
        return redirect($preference->init_point);
    }
    public function receberNotificacao(Request $request)
    {


        // Verifica se a notificação contém os campos necessários
        if (!$request->has('id') || !$request->has('topic')) {
            return response('NOK', 400);
        }

        // Verifica se a notificação é autêntica
        if ($request->input('topic') == 'payment') {
            $payment = Payment::find_by_id($request->input('id'));
            // Verifica o status do pagamento e atualiza o status do pedido no seu sistema
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
                    // Pagamento reembolsado
                    // Atualize o status do pedido para "Pagamento reembolsado"
                    break;
                case 'charged_back':
                    Pedido::where('id', $payment->external_reference)

                        ->update(['status' => "PAGAMENTO ESTORNADO"]);
                    // Pagamento estornado
                    // Atualize o status do pedido para "Pagamento estornado"
                    break;
                default:
                    Pedido::where('id', $payment->external_reference)
                        ->update(['status' => "Não reconhecido"]);
                    // Status de pagamento não reconhecido
                    return response('NOK', 400);
            }

            return response('OK', 200);
        }

        return response('NOK', 400);
    }

    public function gerarQRCodePix()
    {
        // Configure o SDK com as suas credenciais do Mercado Pago


        // Crie um novo pagamento Pix
        $payment = new Payment();

        // Defina as informações do pagamento Pix
        $payment->transaction_amount = 100.00; // Valor do pagamento em reais
        $payment->payment_method_id = "pix"; // Define o pagamento como Pix
        $payment->payer = array(
            "email" => "exemplo@email.com",

        );

        $payment->notification_url = "https://exemplo.com/notificacao"; // URL de notificação para receber informações sobre o pagamento
        $payment->external_reference = uniqid(); // Identificação do pagamento Pix
        // Salve o pagamento para obter o QR Code em diferentes formatos
        $payment->metadata = array(
            "produto" => "camisa",
            "tamanho" => "M",
            "cor" => "azul"
        );
        $payment->statement_descriptor = "Serviços de informáta";
        $payment->save();

        // Obtenha o QR Code em formato base64

        $qrCodePixBase64 = $payment->point_of_interaction->transaction_data->qr_code_base64;

        // Obtenha o link do QR Code Pix
        $qrCodePixUrl = $payment->point_of_interaction->transaction_data->ticket_url;

        $url = $payment->point_of_interaction->transaction_data->qr_code;
        // Retorne o QR Code Pix em formato base64 e o link para a view
        return view('gerar_qr_code_pix', compact('qrCodePixBase64', 'qrCodePixUrl'), ['url' => $url]);
    }



    public function plano(Request $request)
    {

        $params = array(
            "reason" => "Enoun",
            "auto_recurring" => array(
                "frequency" => 1,
                "frequency_type" => "months",
                "repetitions" => 1,
                "billing_day" => 5,
                "billing_day_proportional" => true,
                "free_trial" => array(
                    "frequency" => 3,
                    "frequency_type" => "months"
                ),
                "transaction_amount" => 500,
                "currency_id" => "BRL"
            ),
            "payment_methods_allowed" => array(
                "excluded_payment_types" => array(
                    array(
                        "id" => "ticket"
                    )
                ),
                "excluded_payment_methods" => array(
                    array(
                        "id" => "amex"
                    )
                )
            ),
            "back_url" => "https://www.yoursite.com"
        );

        $response = Http::withToken(env('MERCADO_PAGO_ACCESS_TOKEN'))
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post('https://api.mercadopago.com/preapproval_plan', $params);


        if ($response->failed()) {
            $error = $response->json();
            return response()->json($error, $response->status());
        }

        $result = $response->json();
        return response()->json($result, $response->status());
    }

    public function assinaturaa(Request $request)
    {

        $plano = new Preapproval();
        $plano->external_reference = '202212312359';
        $plano->payer_email = $request->input('email');
        $plano->card_token_id = $request->input('token');
        $plano->preapproval_plan_id = '';
        $plano->auto_recurring = array(
            "frequency" => 1,
            "frequency_type" => "months",
            "transaction_amount" => 500,
            "currency_id" => "BRL",
            "repetitions" => 12,
            "free_trial" => array(
                "frequency" => 1,
                "frequency_type" => "weeks"
            )
        );

        $plano->back_url = route('inicio');
        $plano->reason = "Xtu";
        $plano->status = "authorized";

        $plano->save();
        var_dump($plano);
        return response()->json(['plano_id' => $plano->id]);
    }

    public function assinatura(Request $request)
    {
        $cartao = new Card();
        $cartao->customer_id = '1330581867-sELyj5ZR8D91No';
        $cartao->token=$request['token'];
        $cartao->save();
        //ofc
        $preapproval = new Preapproval();
        $preapproval->payer_email = $request['email'];
        $preapproval->preapproval_plan_id = '2c93808486feba790186ff29bc600037';
        $preapproval->back_url = 'https://www.yourwebsite.com/return';
        $preapproval->auto_recurring = array(
            "frequency" => 1,
            "frequency_type" => "months",
            "transaction_amount" => 500,
            "currency_id" => "BRL",
            "repetitions" => 12
        );
        $preapproval->status = "authorized";
        $preapproval->external_reference = "ok ok";
        $preapproval->card_token_id = $request['token'];
        $preapproval->reason = "Some reason";
       
        $preapproval->save();
      dd($preapproval);
      var_dump($preapproval);
    }
    public function pagamentoCheckoutTransparente(Request $request)
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
        $payer->identification = array(
            "type" => $request->input('identificationType'),
            "number" => $request->input('identificationNumber')
        );
        $payment->payer = $payer;
        $payment->save();

        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );
        dd($response);
    }

    public function criarCliente(Request  $request)
    {
        //cria cliente e cartão
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

        // Salve o novo cliente na plataforma de pagamentos do MercadoPago
        $customer->save();

        $card = new Card();
        $card->token = $request->input('token');
        $card->customer_id = $customer->id;
        $card->issuer = array("id" => "25");
        $card->payment_method = array("id" => "credit_card");
        $card->save();
        dd($card);
    }

    public function buscarCliente()
    {
        $email = ['email' => 'e@gmail.com'];
        $response = Http::withToken(env('MERCADO_PAGO_ACCESS_TOKEN'))
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->get('https://api.mercadopago.com//v1/customers/search?', $email);

        $resultaado = $response->json();
    }
    public function exibirCliente()
    {
        //retorna todos dados completo do cliente
        $id = '';
        $response = Http::withToken(env('MERCADO_PAGO_ACCESS'))
            ->withHeaders(['Content-Type' => 'application/json'])
            ->get('https://api.mercadopago.com/v1/customers/', $id);
        $resultado = $response->json();
    }
}
