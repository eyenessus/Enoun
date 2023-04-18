<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagseguroController extends Controller
{
    public function index()
    {
        return view('Pay.PagSeguro.pagSeguroCard');
    }

    public function cartaoCredito(Request $request)
    {
        
        $data = [
            "reference_id" => "ex-00001",
            "customer" => [
                "name" => "Jose da Silva",
                "email" => "email@test.com",
                "tax_id" => "12345678909",
                "phones" => [
                    [
                        "country" => "55",
                        "area" => "11",
                        "number" => "999999999",
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => [
                [
                    "reference_id" => "referencia do item",
                    "name" => "nome do item",
                    "quantity" => 1,
                    "unit_amount" => 500
                ]
            ],
            "shipping" => [
                "address" => [
                    "street" => "Avenida Brigadeiro Faria Lima",
                    "number" => "1384",
                    "complement" => "apto 12",
                    "locality" => "Pinheiros",
                    "city" => "São Paulo",
                    "region_code" => "SP",
                    "country" => "BRA",
                    "postal_code" => "01452002"
                ]
            ],
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ],
            "charges" => [
                [
                    "reference_id" => "referencia da cobranca",
                    "description" => "descricao da cobranca",
                    "amount" => [
                        "value" => 100000,
                        "currency" => "BRL"
                    ],
                    "payment_method" => [
                        "type" => "CREDIT_CARD",
                        "installments" => 1,
                        "capture" => true,
                        "card" => [
                            "encrypted" => $request['token'],
                            "security_code" => "123",
                            "holder" => [
                                "name" => "Jose da Silva"
                            ],
                            "store" => false
                        ]
                    ]
                ]
            ]
        ];


        $resposta = Http::withToken('')
            ->withHeaders(
                [
                    'Content-type' => 'application/json'
                ]
            )->post("https://sandbox.api.pagseguro.com/orders", $data);

        dd($resposta->json());
    }

    public function boleto()
    {
        $data = [
            "reference_id" => "ex-00001",
            "customer" => [
                "name" => "Jose da Silva",
                "email" => "email@test.com",
                "tax_id" => "12345678909",
                "phones" => [
                    [
                        "country" => "55",
                        "area" => "11",
                        "number" => "999999999",
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => [
                [
                    "reference_id" => "referencia do item",
                    "name" => "nome do item",
                    "quantity" => 1,
                    "unit_amount" => 500
                ]
            ],
            "shipping" => [
                "address" => [
                    "street" => "Avenida Brigadeiro Faria Lima",
                    "number" => "1384",
                    "complement" => "apto 12",
                    "locality" => "Pinheiros",
                    "city" => "São Paulo",
                    "region_code" => "SP",
                    "country" => "BRA",
                    "postal_code" => "01452002"
                ]
            ],
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ],
            "charges" => [
                [
                    "reference_id" => "referencia da cobranca",
                    "description" => "descricao da cobranca",
                    "amount" => [
                        "value" => 500,
                        "currency" => "BRL"
                    ],
                    "payment_method" => [
                        "type" => "BOLETO",
                        "boleto" => [
                            "due_date" => "2023-06-20",
                            "instruction_lines" => [
                                "line_1" => "Pagamento processado para DESC Fatura",
                                "line_2" => "Via PagSeguro"
                            ],
                            "holder" => [
                                "name" => "Jose da Silva",
                                "tax_id" => "22222222222",
                                "email" => "jose@email.com",
                                "address" => [
                                    "country" => "Brasil",
                                    "region" => "São Paulo",
                                    "region_code" => "SP",
                                    "city" => "Sao Paulo",
                                    "postal_code" => "01452002",
                                    "street" => "Avenida Brigadeiro Faria Lima",
                                    "number" => "1384",
                                    "locality" => "Pinheiros"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $resposta = http::withToken('')->withHeaders([
            'Content-type' => 'application/json'
        ])->post('https://sandbox.api.pagseguro.com/orders', $data);

        dd($resposta->json());
    }
    public function pix()
    {
        $data = [
            "reference_id" => "ex-00001",
            "customer" => [
                "name" => "Jose da Silva",
                "email" => "email@test.com",
                "tax_id" => "12345678909",
                "phones" => [
                    [
                        "country" => "55",
                        "area" => "11",
                        "number" => "999999999",
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => [
                [
                    "name" => "nome do item",
                    "quantity" => 1,
                    "unit_amount" => 500
                ]
            ],
            "qr_codes" => [
                [
                    "amount" => [
                        "value" => 500
                    ],
                    "expiration_date" => "2023-04-29T20:15:59-03:00"
                ]
            ],
            "shipping" => [
                "address" => [
                    "street" => "Avenida Brigadeiro Faria Lima",
                    "number" => "1384",
                    "complement" => "apto 12",
                    "locality" => "Pinheiros",
                    "city" => "São Paulo",
                    "region_code" => "SP",
                    "country" => "BRA",
                    "postal_code" => "01452002"
                ]
            ],
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ]
        ];

        $resposta = http::withToken('')->withHeaders([
            'Content-type' => 'application/json'
        ])->post('https://sandbox.api.pagseguro.com/orders', $data);

        dd($resposta->json());
    }

    public function assinaturaDeRecorrenciaSubsequente()
    {
        $dados = [
            "reference_id" => "ex-00001",
            "customer" => [
                "name" => "Jose da Silva",
                "email" => "email@test.com",
                "tax_id" => "12345678909",
                "phones" => [
                    [
                        "country" => "55",
                        "area" => "11",
                        "number" => "999999999",
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => [
                [
                    "reference_id" => "referencia do item",
                    "name" => "nome do item",
                    "quantity" => 1,
                    "unit_amount" => 500
                ]
            ],
            "shipping" => [
                "address" => [
                    "street" => "Avenida Brigadeiro Faria Lima",
                    "number" => "1384",
                    "complement" => "apto 12",
                    "locality" => "Pinheiros",
                    "city" => "São Paulo",
                    "region_code" => "SP",
                    "country" => "BRA",
                    "postal_code" => "01452002"
                ]
            ],
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ],
            "charges" => [
                [
                    "reference_id" => "referencia da cobranca",
                    "description" => "descricao da cobranca",
                    "amount" => [
                        "value" => 500,
                        "currency" => "BRL"
                    ],
                    "payment_method" => [
                        "type" => "CREDIT_CARD",
                        "installments" => 1,
                        "capture" => true,
                        "card" => [
                            "encrypted" => "HmhNVoiK9TbvMa66DQPusEvRMg8yFLEkivW/cHgAwPsxo0C48mCocCqfmyNBQB6ofCjO4K7RgK7tvyxytrZtjqIeIwDRtl9kQyF8EgqRW1EzHX1gmTVyj6P+S+w1r55rYsuVRbqcGDDSwcRXXzavWHJhpbppLqdS+kr9SH8YBU4wyuOnyVStr/VWzswr4m+DBQX9dmu4k3KEhv88B2Qa5n15FpCBJ7CBi9LE7oZ7ODEXLrK6byPAqFMWoTCCHJW8u+qM9i/Y0e/TS4o7FpmoXcrh3/YzhkUaxAozb0l1RNZ4YOQapnixrG+3BzjLhOvyp+0UbjU2r0583IPFf5HcCg==",
                            "security_code" => "123",
                            "holder" => [
                                "name" => "Jose da Silva"
                            ],
                            "store" => true
                        ]
                    ],
                    "recurring" => [
                        "type" => "SUBSEQUENT"
                    ]
                ]
            ]
        ];
        $resposta = http::withToken('')->withHeaders([
            'Content-type' => 'application/json'
        ])->post('https://sandbox.api.pagseguro.com/orders', $dados);

        dd($resposta->json());
    }

    public function assinaturaDeRecorrenciaInital()
    {
        $dados = [
            "reference_id" => "ex-00001",
            "customer" => [
                "name" => "Jose da Silva",
                "email" => "email@test.com",
                "tax_id" => "12345678909",
                "phones" => [
                    [
                        "country" => "55",
                        "area" => "11",
                        "number" => "999999999",
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => [
                [
                    "reference_id" => "referencia do item",
                    "name" => "nome do item",
                    "quantity" => 1,
                    "unit_amount" => 500
                ]
            ],
            "shipping" => [
                "address" => [
                    "street" => "Avenida Brigadeiro Faria Lima",
                    "number" => "1384",
                    "complement" => "apto 12",
                    "locality" => "Pinheiros",
                    "city" => "São Paulo",
                    "region_code" => "SP",
                    "country" => "BRA",
                    "postal_code" => "01452002"
                ]
            ],
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ],
            "charges" => [
                [
                    "reference_id" => "referencia da cobranca",
                    "description" => "descricao da cobranca",
                    "amount" => [
                        "value" => 500,
                        "currency" => "BRL"
                    ],
                    "payment_method" => [
                        "type" => "CREDIT_CARD",
                        "installments" => 1,
                        "capture" => true,
                        "card" => [
                            "encrypted" => "HmhNVoiK9TbvMa66DQPusEvRMg8yFLEkivW/cHgAwPsxo0C48mCocCqfmyNBQB6ofCjO4K7RgK7tvyxytrZtjqIeIwDRtl9kQyF8EgqRW1EzHX1gmTVyj6P+S+w1r55rYsuVRbqcGDDSwcRXXzavWHJhpbppLqdS+kr9SH8YBU4wyuOnyVStr/VWzswr4m+DBQX9dmu4k3KEhv88B2Qa5n15FpCBJ7CBi9LE7oZ7ODEXLrK6byPAqFMWoTCCHJW8u+qM9i/Y0e/TS4o7FpmoXcrh3/YzhkUaxAozb0l1RNZ4YOQapnixrG+3BzjLhOvyp+0UbjU2r0583IPFf5HcCg==",
                            "security_code" => "123",
                            "holder" => [
                                "name" => "Jose da Silva"
                            ],
                            "store" => true
                        ]
                    ],
                    "recurring" => [
                        "type" => "INITIAL"
                    ]
                ]
            ]
        ];
        $resposta = http::withToken('')->withHeaders([
            'Content-type' => 'application/json'
        ])->post('https://sandbox.api.pagseguro.com/orders', $dados);

        dd($resposta->json());
    }
}
