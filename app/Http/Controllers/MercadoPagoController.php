<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
                'title' => 'Scient teste',
                'description' => 'Descrição do produto 1',
                'quantity' => 4,
                'unit_price' => 9.0,
            ],
            [
                'title' => 'Homem aranha',
                'description' => 'Descrição do produto 2',
                'quantity' => 1,
                'unit_price' => 4.0,
            ], [
                'title' => 'Scient teste',
                'description' => 'Descrição do produto 1',
                'quantity' => 4,
                'unit_price' => 9.0,
            ],
            [
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
        $preference->payer = $payer;


        // Configure as URLs de retorno
        $preference->back_urls = array(
            "success" => "https://example.com/success",
            "failure" => "google.com",
            "pending" => "https://example.com/pending"
        );
        
        $preference->description = 'Servicos de informática';

        $preference->notification_url = "https://example.com/notification";

        // Salve a preferência
        $preference->save();
        
        // Redirecione o usuário para a página de pagamento do Mercado Pago
        return redirect($preference->init_point);
    }
}
