<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preference;
use MercadoPago\SDK;

class MercadoPagoController extends Controller
{
    public function criarPagamento($itemsCar,$cliente)
    {
        dd($cliente);
        SDK::initialize();
        SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
        SDK::setIntegratorId('INTEGRATOR_ID');

        // Crie uma nova preferência
        $preference = new Preference();

        
        // Configure os itens que serão incluídos na preferência
        $items = [];

        foreach ($itemsCar as $servico) {
          
            $item = new Item();
            $item->title = $servico['nome'];
            $item->description = $servico['descricao'];
            $item->quantity = $servico->pivot['quantidade'];
            $item->unit_price = $servico['preco'];

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
            'number' => '12345678900'
        ];
        $payer->address = [
            'zip_code' => $cliente->cep,
            'street_name' => $cliente->endereco,
            'street_number' => $cliente->nome,
            'floor' => '8',
            'apartment' => '85',
            'city' => $cliente->cidade,
            'state' => $cliente->estado,
            'country' => 'BR'
        ];
        $preference->external_reference = $cliente->id;
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
     
        // Redirecione o usuário para a página de pagamento do Mercado Pago
        return redirect($preference->init_point);
    }
    public function receberNotificacao(Request $request)
    {
        SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
    
        // Verifica se a notificação contém os campos necessários
        if (!$request->has('id') || !$request->has('topic')) {
            return response('NOK', 400);
        }
    
        // Verifica se a notificação é autêntica
        if ($request->input('topic') == 'payment') {
            $payment = \MercadoPago\Payment::find_by_id($request->input('id'));
            // Verifica o status do pagamento e atualiza o status do pedido no seu sistema
    
            switch ($payment->status) {
                case 'approved':
                    // Pagamento aprovado
                    // Atualize o status do pedido para "Pago"
                    dd("aprovado");
                    break;
                case 'pending':
                    // Pagamento pendente
                    // Atualize o status do pedido para "Pendente de pagamento"
                    dd('Está pendente');
                    break;
                case 'in_process':
                    // Pagamento em processo
                    // Atualize o status do pedido para "Pagamento em processo"
                    dd('Está processando');
                    break;
                case 'rejected':
                    // Pagamento rejeitado
                    // Atualize o status do pedido para "Pagamento rejeitado"
                    dd('Está rejeitado');
                    break;
                case 'cancelled':
                    // Pagamento cancelado
                    // Atualize o status do pedido para "Pagamento cancelado"
                    break;
                case 'refunded':
                    // Pagamento reembolsado
                    // Atualize o status do pedido para "Pagamento reembolsado"
                    break;
                case 'charged_back':
                    // Pagamento estornado
                    // Atualize o status do pedido para "Pagamento estornado"
                    break;
                default:
                    // Status de pagamento não reconhecido
                    return response('NOK', 400);
            }
            
            return response('OK', 200);
        }
    
        return response('NOK', 400);
    }
    

}
