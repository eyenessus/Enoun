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
    public function __construct(protected MercadoPagoService $service)
    {
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
        if(!$total)
        {
            return redirect()->route('inicio');
        }
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

    public function salvarCartao(Request $request)
    {
      $retorno = $this->service->salvarCartao($request);
      if (!$retorno) {
        dd('confira os dados do cartão');
      }
      return redirect()->route('inicio');
    }


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
    
}
