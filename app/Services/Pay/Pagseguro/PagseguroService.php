<?php

namespace App\Services\Pay\Pagseguro;

use App\Models\Pedido;
use App\Models\User;
use App\Repositories\Pay\MercadoPago\MercadoPagoInterface;
use App\Repositories\Pay\Pagseguro\PagseguroInterface;
use App\Services\User\UserEnounService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PagseguroService
{
    private $userAuth;
    public function __construct(
        protected PagseguroInterface $respository,
        protected UserEnounService $userService,
    ) {
    }

    public function identificacaoUsuario()
    {
        $this->userAuth = User::findOrFail(Auth::id());
    }
    public function cartaoCredito(Request $request)
    {
        $this->identificacaoUsuario();
        $finalizarPedido = $this->userService->finalizarPedido();
        $pedido = $this->userService->buscarItensCarrinho();
        $bloco = [];

        foreach (array_merge($pedido['produto']->toArray(), $pedido['servicos']->toArray()) as $item) {

            $pedidoItem['reference_id'] = $item['id'];
            $pedidoItem['name'] = $item['nome'];
            $pedidoItem['quantity'] = $item['descricao'];
            $pedidoItem['quantity'] = $item['pivot']['quantidade'];
            $pedidoItem['unit_amount'] = $item['valor'];
            $bloco[] = $pedidoItem;
        }

        $data = [
            "reference_id" => "ex-00001",
            "customer" => [
                "name" => $this->userAuth->nome,
                "email" =>  $this->userAuth->email,
                "tax_id" =>  $this->userAuth->identidade->documento,
                "phones" => [
                    [
                        "country" => "55",
                        "area" => $this->userAuth->identidade->codigo_area,
                        "number" => $this->userAuth->identidade->telefone,
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => $bloco,
            "shipping" => [
                "address" => [
                    "street" => $this->userAuth->endereco->rua,
                    "number" => $this->userAuth->endereco->numero,
                    "complement" => $this->userAuth->endereco->complemento,
                    "locality" => "Pinheiros",
                    "city" => $this->userAuth->endereco->cidade,
                    "region_code" => $this->userAuth->endereco->estado,
                    "country" => "BRA",
                    "postal_code" => $this->userAuth->endereco->cep
                ]
            ],
            "notification_urls" => [
                "https://webhook.site/f5140fda-b70c-4caf-9ae8-bf61210412c1"
            ],
            "charges" => [
                [
                    "reference_id" => "referencia da cobranca",
                    "description" => "descricao da cobranca",
                    "amount" => [
                        "value" =>  $finalizarPedido['valorTotal'] . "00",
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
        $resposta = Http::withToken(env('PAGSEGURO_TOKEN'))
            ->withHeaders(
                [
                    'Content-type' => 'application/json'
                ]
            )->post("https://sandbox.api.pagseguro.com/orders", $data);

        dd($resposta->json());
    }

    public function boleto()
    {
        $this->identificacaoUsuario();
        $finalizarPedido = $this->userService->finalizarPedido();

        $pedido = $this->userService->buscarItensCarrinho();

        $bloco = [];

        foreach (array_merge($pedido['produto']->toArray(), $pedido['servicos']->toArray()) as $item) {

            $pedidoItem['reference_id'] = $item['id'];
            $pedidoItem['name'] = $item['nome'];
            $pedidoItem['quantity'] = $item['descricao'];
            $pedidoItem['quantity'] = $item['pivot']['quantidade'];
            $pedidoItem['unit_amount'] = str_replace(['.'],"",round($item['valor']));
            $bloco[] = $pedidoItem;
        }

        $data = [
            "reference_id" => $finalizarPedido['id'],
            "customer" => [
                "name" => $this->userAuth->nome,
                "email" =>  $this->userAuth->email,
                "tax_id" =>  $this->userAuth->identidade->documento,
                "phones" => [
                    [
                        "country" => "55",
                        "area" => $this->userAuth->identidade->codigo_area,
                        "number" => $this->userAuth->identidade->telefone,
                        "type" => "MOBILE"
                    ]
                ]
            ],

            "items" => $bloco,
            "shipping" => [
                "address" => [
                    "street" => $this->userAuth->endereco->rua,
                    "number" => $this->userAuth->endereco->numero,
                    "complement" => $this->userAuth->endereco->complemento,
                    "locality" => "Pinheiros",
                    "city" => $this->userAuth->endereco->cidade,
                    "region_code" => $this->userAuth->endereco->estado,
                    "country" => "BRA",
                    "postal_code" => $this->userAuth->endereco->cep
                ]
            ],
            "notification_urls" => [
                "https://webhook.site/f5140fda-b70c-4caf-9ae8-bf61210412c1"
            ],
            "charges" => [
                [
                    "reference_id" => "referencia da cobranca",
                    "description" => "descricao da cobranca",
                    "amount" => [
                        "value" =>  str_replace(['.'],"",round($finalizarPedido['valorTotal'])) . "00",
                        "currency" => "BRL"
                    ],
                    "payment_method" => [
                        "type" => "BOLETO",
                        "boleto" => [
                            "due_date" => "2023-06-20",
                            "instruction_lines" => [
                                "line_1" => "Pagamento processado para DESC Fatura",
                                "line_2" => "Enoun Central - Oficial",

                            ],
                            "holder" => [
                                "name" => $this->userAuth->nome,
                                "tax_id" =>  $this->userAuth->identidade->documento,
                                "email" => $this->userAuth->email,
                                "address" => [
                                    "country" => "Brasil",
                                    "region" => $this->userAuth->endereco->cidade,
                                    "region_code" => $this->userAuth->endereco->estado,
                                    "city" => $this->userAuth->endereco->cidade,
                                    "postal_code" => $this->userAuth->endereco->cep,
                                    "street" => $this->userAuth->endereco->rua,
                                    "number" => $this->userAuth->endereco->numero,
                                    "locality" => $this->userAuth->endereco->cidade
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $resposta = http::withToken(env('PAGSEGURO_TOKEN'))->withHeaders([
            'Content-type' => 'application/json'
        ])->post('https://sandbox.api.pagseguro.com/orders', $data);
        $resposta = $resposta->json();
        $pdfLink = $resposta['charges'][0]['links'][0]['href'];
        return $pdfLink;
    }
    public function pix()
    {
        
        $this->identificacaoUsuario();

       
        $pedido = $this->userService->buscarItensCarrinho();
        $finalizarPedido = $this->userService->finalizarPedido();
        $bloco = [];
        foreach (array_merge($pedido['produto']->toArray(), $pedido['servicos']->toArray()) as $item) {
            $pedidoItem['reference_id'] = $item['id'];
            $pedidoItem['name'] = $item['nome'];
            $pedidoItem['quantity'] = $item['descricao'];
            $pedidoItem['quantity'] = $item['pivot']['quantidade'];
            $pedidoItem['unit_amount'] = str_replace(['.'],"",round($item['valor']));
            $bloco[] = $pedidoItem;
        }
        $data = [
            "reference_id" => $finalizarPedido['id'],
            "customer" => [
                "name" => $this->userAuth->nome,
                "email" =>  $this->userAuth->email,
                "tax_id" =>  $this->userAuth->identidade->documento,
                "phones" => [
                    [
                        "country" => "55",
                        "area" => $this->userAuth->identidade->codigo_area,
                        "number" => $this->userAuth->identidade->telefone,
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => $bloco,
            "qr_codes" => [
                [
                    "amount" => [
                        "value" => str_replace(['.'],"",round($finalizarPedido['valorTotal']))
                    ],
                    "expiration_date" => Carbon::now()->addHours(2)
                ]
            ],
            "shipping" => [
                "address" => [
                    "street" => $this->userAuth->endereco->rua,
                    "number" => $this->userAuth->endereco->numero,
                    "complement" => $this->userAuth->endereco->complemento,
                    "locality" => "Pinheiros",
                    "city" => $this->userAuth->endereco->cidade,
                    "region_code" => $this->userAuth->endereco->estado,
                    "country" => "BRA",
                    "postal_code" => $this->userAuth->endereco->cep
                ]
            ],
            "notification_urls" => [
                "https://meusite.com/notificacoes"
            ]
        ];

        $resposta = http::withToken(env('PAGSEGURO_TOKEN'))->withHeaders([
            'Content-type' => 'application/json'
        ])->post('https://sandbox.api.pagseguro.com/orders', $data);
        $resposta = $resposta->json();
        $response = [
            'textoCopiaEcola' => $resposta['qr_codes'][0]['text'],
            'qrCode' => $resposta['qr_codes'][0]['links'][0]['href'],
            'total' => $resposta['qr_codes'][0]['amount']['value']
        ];

        return $response;
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
        $resposta = http::withToken(env('PAGSEGURO_TOKEN'))->withHeaders([
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
        $resposta = Http::withToken(env('PAGSEGURO_TOKEN'))->withHeaders([
            'Content-type' => 'application/json'
        ])->post('https://sandbox.api.pagseguro.com/orders', $dados);

        dd($resposta->json());
    }

    public function receberNotificacoes(Request $request)
    {
        $token = env('PAGSEGURO_TOKEN');
        $payload = $request->getContent();
        $tokenPagSeguro = $request->header('x-authenticity-token');
        $data = $token . '-' . $payload;
        $signature = hash('sha256', $data);

        if ($signature === $tokenPagSeguro) {
            $dataJson = json_decode($payload);

            switch ($dataJson->charges[0]->status) {

                case 'INITIATED':
                    Pedido::where('id', $dataJson->reference_id)
                        ->update(['status' => 'INICIADO']);
                    break;
                case 'WAITING_PAYMENT':
                    Pedido::where('id', $dataJson->reference_id)
                        ->update(['status' => 'AGUARDANDO PAGAMENTO']);
                    break;
                case 'WAITING':
                    Pedido::where('id', $dataJson->reference_id)
                        ->update(['status' => 'AGUARDANDO PAGAMENTO']);
                    break;
                case 'IN_ANALYSIS':
                    Pedido::where('id', $dataJson->reference_id)
                        ->update(['status' => 'EM ANÁLISE']);
                    break;
                case 'PAID':
                    Pedido::where('id', $dataJson->reference_id)
                        ->update(['status' => 'PAGO']);
                    break;
                case 'AVAILABLE':
                    Pedido::where('id', $dataJson->reference_id)
                        ->update(['status' => 'DISPONÍVEL']);
                    break;
                case 'IN_DISPUTE':
                    Pedido::where('id', $dataJson->reference_id)
                        ->update(['status' => 'EM DISPUTA']);
                    break;
                case 'REFUNDED':
                    Pedido::where('id', $dataJson->reference_id)
                        ->update(['status' => 'REEMBOLSADO']);
                    break;
                case 'CANCELLED':
                    Pedido::where('id', $dataJson->reference_id)
                        ->update(['status' => 'CANCELADO']);
                    break;
                default:
                    Pedido::where('id', $dataJson->reference_id)
                        ->update(['status' => 'NÃO RECONHECIDO']);
            }

            return response('OK', 200);
        }
    }
}
