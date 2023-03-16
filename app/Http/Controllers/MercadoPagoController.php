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
use MercadoPago\Plan;
use MercadoPago\Preapproval;
use MercadoPago\Preference;
use MercadoPago\SDK;
use MercadoPago\Payment;
use MercadoPago\PreapprovalPlan;
use MercadoPago\Subscription;
use Symfony\Component\HttpClient\HttpClient;
use MercadoPago\SubscriptionPlan;
use Symfony\Component\VarDumper\Caster\CutStub;

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
                "transaction_amount" => 1,
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

    public function geradorToken()
    {

        $cardToken = new CardToken();
        $cardToken->cardholderName = 'Emerson dos santos sousa';
        $cardToken->cardNumber = '4092800152289025';
        $cardToken->securityCode = '013';
        $cardToken->expirationMonth = '03';
        $cardToken->expirationYear = '2028';
        $cardToken->identificationType = 'CPF';
        $cardToken->identificationNumber = '52781012882'; // insira o CPF do usuário aqui

        $cardToken->save();
        $cardTokenId = $cardToken->id;

        return $cardTokenId;
    }
    public function assinatura(Request $request)
    {


        $plano = new Preapproval();

        $plano->description = $request->input('descricao');
        $plano->external_reference = $request->input('referencia');
        $plano->payer_email = 'eyenessus@email.com';
        $plano->preapproval_plan_id = '2c93808486e9fd3d0186ec7c1560010f';
        $plano->card_token_id = $this->geradorToken();
        $plano->auto_recurring = array(
            "frequency" => $request->input('frequencia'),
            "frequency_type" => $request->input('tipo_frequencia'),
            "transaction_amount" => $request->input('valor'),
            "currency_id" => $request->input('moeda'),
            "repetitions" => $request->input('repeticoes'),
            "free_trial" => array(
                "frequency" => $request->input('frequencia_teste'),
                "frequency_type" => $request->input('tipo_frequencia_teste')
            )
        );
        $plano->back_url = route('inicio');
        $plano->reason = "Xtu";

        $plano->save();

        return response()->json(['plano_id' => $plano->id]);
    }


    public function criarCliente()
    {
        //cria cliente e cartão
        $cliente = new Customer();
        $cliente->email = 'osd@gmail.com';
        $cliente->save();
        
        $card = new Card();
        $card->token = $this->geradorToken();
        $card->customer_id = $cliente->id;
        $card->issuer = array("id" => "3245612");
        $card->payment_method = array("id" => "debit_card");
        $card->save();
       
      
    }

    public function buscarCliente(){
        
        $email = ['email'=>'e@gmail.com'];
        $response = Http::withToken(env('MERCADO_PAGO_ACCESS_TOKEN'))
        ->withHeaders([
            'Content-Type' => 'application/json'
        ])
        ->get('https://api.mercadopago.com//v1/customers/search?', $email);
        
            $resultaado = $response->json();
    }
}
