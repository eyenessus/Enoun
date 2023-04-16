<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Pay\MercadoPago\MercadoPagoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Card;
use MercadoPago\CardToken;
use MercadoPago\Customer;
use MercadoPago\SDK;

class MercadoPagoController extends Controller
{
    private $clienteMercadoPago;
    private $userAuth;
    public function __construct(protected MercadoPagoService $service)
    {
    }
    public function identificacaoUser()
    {
        $usuarioAuthEncontrado = $this->userAuth = User::findOrFail(Auth::id());
        $this->clienteMercadoPago = Customer::search(['email'=>$usuarioAuthEncontrado->email]);
        SDK::setClientId($this->clienteMercadoPago[0]->id);
    }

    public function index()
    {
        $processandoPay = $this->service->paymentPreference();
        return redirect($processandoPay);
    }

    public function cartao()
    {
        $dados = $this->service->buscarDadosCliente();
        $total = (int) $this->service->fecharCompra();
        return view('Pay.MercadoPago.mercadoPago', compact('dados', 'total'));
    }


    public function boleto()
    {
        $boleto = $this->service->boletoBradesco();
        if(!$boleto){
            return redirect()->route('inicio');
        }
        return redirect($boleto);
    }


    public function pix()
    {
        $pix = $this->service->qrCodePix();
        if (!$pix) {
            return redirect()->route('inicio');
        }
        return view('Pay.MercadoPago.mercadoPagoQrCode', compact('pix'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $teste = $this->service->paymentCartaoCredito($request);
        dd($teste);
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }

    public function salvarCartao()
    {}


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
    public function teste()
    {
        
         $this->identificacaoUser();
        
    
       //SDK::setClientId($cliente[0]->id);
       
        $clienteId= SDK::getClientId();
        dd($clienteId);
        $cardToken = new CardToken();
        $cardToken->cardholderName = 'Emerson Sousa';
        $cardToken->cardNumber = '5585989836653671';
        $cardToken->securityCode = '013';
        $cardToken->expirationMonth = '03';
        $cardToken->expirationYear = '2028';
        $cardToken->identificationType = 'CPF';
        $cardToken->identificationNumber = '45585098047';
        $cardToken->save();

        $card = new Card();
        $card->token = $cardToken->id;;
        $card->customer_id = SDK::getClientId();
        $card->issuer = array("id" => "25");
        $card->payment_method = array("id" => "credit_card");
        $card->save();
       dd($card);
       
        }
}
