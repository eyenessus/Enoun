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
    public function criarPagamento()
    {
        SDK::initialize();
        SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
        SDK::setIntegratorId('INTEGRATOR_ID');

        // Crie uma nova preferência
        $preference = new Preference();

        // Configure os itens que serão incluídos na preferência
        $items = [];

        $produtos = [
            [
                "id"=> 1,
                 "category_id" => 2,
                'title' => 'Scient teste',
                'description' => 'Descrição do produto 1',
                'quantity' => 4,
                'unit_price' => 9.0,
            ],
            [
                "id"=> 2,
                 "category_id" => 3,
                'title' => 'Homem aranha',
                'description' => 'Descrição do produto 2',
                'quantity' => 1,
                'unit_price' => 4.0,
            ], [
                "id"=> 4,
                 "category_id" => 5,
                'title' => 'Scient teste',
                'description' => 'Descrição do produto 1',
                'quantity' => 4,
                'unit_price' => 9.0,
            ],
            [
                "id"=> 56,
                 "category_id" => 88,
                'title' => 'Homem aranha',
                'description' => 'Descrição do produto 2',
                'quantity' => 1,
                'unit_price' => 4.0,
            ],
        ];

        foreach ($produtos as $produto) {
            $item = new Item();
            $item->title = $produto['title'];
            $item->description = $produto['description'];
            $item->quantity = $produto['quantity'];
            $item->unit_price = $produto['unit_price'];

            $items[] = $item;
        }

        $preference->items = $items;


        // Configure o pagador da preferência
        $payer = new Payer();
        
        $payer->email = 'e@exemplo.com';
        $payer->name = 'João';
        $payer->surname = 'Silva';
        $payer->phone = [
            'area_code' => '11',
            'number' => '12345678'
        ];
        $payer->identification = [
            'type' => 'CPF',
            'number' => '12345678900'
        ];
        $payer->address = [
            'zip_code' => '01234-567',
            'street_name' => 'Rua Teste',
            'street_number' => '123',
            'floor' => '8',
            'apartment' => '85',
            'city' => 'São Paulo',
            'state' => 'SP',
            'country' => 'BR'
        ];
        $preference->external_reference = '007';
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
    SDK::initialize();
    SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
    
    // Verifica se a notificação contém os campos necessários
    if (!$request->has('id') || !$request->has('topic')) {
        return response('NOK', 400);
    }
    
    // Verifica se a notificação é autêntica
    if ($request->input('topic') == 'payment') {
        $payment = \MercadoPago\Payment::find_by_id($request->input('id'));
        // Verifica o status do pagamento e atualiza o status do pedido no seu sistema
        if ($payment->status == 'approved') {
            // Pagamento aprovado
    
            // Atualize o status do pedido para "Pago"
        } else if ($payment->status == 'pending') {
            // Pagamento pendente
            // Atualize o status do pedido para "Pendente de pagamento"
        } else if ($payment->status == 'in_process') {
            // Pagamento em processo
            
            // Atualize o status do pedido para "Pagamento em processo"
        } else if ($payment->status == 'rejected') {
            // Pagamento rejeitado
            
            // Atualize o status do pedido para "Pagamento rejeitado"
        } else if ($payment->status == 'cancelled') {
            // Pagamento cancelado
            // Atualize o status do pedido para "Pagamento cancelado"
        } else if ($payment->status == 'refunded') {
            // Pagamento reembolsado
            // Atualize o status do pedido para "Pagamento reembolsado"
        } else if ($payment->status == 'charged_back') {
            // Pagamento estornado
            // Atualize o status do pedido para "Pagamento estornado"
        }
        
        return response('OK', 200);
    }
    
    return response('NOK', 400);
    
}

}
