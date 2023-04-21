<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use App\Services\Pay\MercadoPago\MercadoPagoService;
use App\Services\User\UserEnounService;
use Illuminate\Http\Request;



class MercadoPagoController extends Controller
{
    public function __construct(
        protected MercadoPagoService $service,
        protected UserEnounService $serviceUser
    ) {
    }

    public function index()
    {
        $processandoPay = $this->service->paymentPreference();
        return redirect($processandoPay);
    }

    public function cartaoPagamento()
    {
        $dados = $this->service->buscarDadosCliente();
        $total = $this->serviceUser->valorFinal();
        if (!$total) {
            return redirect()->route('inicio');
        }
        return view('Pay.MercadoPago.mercadoPago', compact('dados', 'total'));
    }


    public function boleto()
    {
        $boleto = $this->service->boletoBradesco();
        if (!$boleto) {
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



    public function store(Request $request)
    {
        $status = $this->service->paymentCartaoCredito($request);
        if ($status['status'] == "approved") {
            return redirect()->route('meusPedidos');
        }
        return redirect()->route('inicio');
    }



    public function update(Request $request)
    {
        $resposta = $this->service->atualizarCartao($request);
        return redirect()->route('inicio');
    }


    public function destroy(string $id)
    {
        $resposta =  $this->service->excluirCartao($id);
        if ($resposta) {
            return redirect()->route('meusCartoes');
        }
    }
    

    public function formSalvarCartao()
    {
        return view('Pay.MercadoPago.mercadoPagoSaveCartao');
    }


    public function salvarCartao(Request $request)
    {
        $retorno = $this->service->salvarCartao($request);
        if ($retorno) {
            return redirect()->route('carrinho.index');
        }
        return redirect()->route('inicio');
    }


    public function obterTodosCartoes()
    {
        $cartoes = $this->service->obterTodosCartoes();
        
        return view('Pay.MercadoPago.mercadoPagoCartoes', compact('cartoes'));
    }


    public function atualizarCartao(string $id)
    {
        $dados = $this->service->encontrarCartao($id);
        return view('Pay.MercadoPago.mpEditarCartao', compact('dados'));
    }


    public function receberNotificacoes(Request $request)
    {

        $this->service->notificacoesMercadoPago($request);
    }

    public function criarAssinatura(Request $request)
    {
        $this->service->criarAssinatura($request);
    }
    public function formAssinatura()
    {
        return view('Pay.MercadoPago.mercadoPagoAssinatura');
    }
    public function criarPlanoAssinatura(Request $request)
    {
        $resposta = $this->service->criarPlanoAssinatura($request);
        if ($resposta) {
            return redirect()->route('verPlanosAssinatura');
        }
    }
    public function criarCliente()
    {
        $this->service->criarCliente();
    }

    public function verTodosPlanosDeAssinatura()
    {
        $planos = $this->service->buscarTodosPlanosDeAssinatura();
        $planos = collect($planos['results']);
        return view('Gerenciamento.Plano.planos', compact('planos'));
    }


    public function verTodasAssinaturas()
    {
        $assinatura = $this->service->buscarTodosPlanosDeAssinatura();
        $assinatura = collect($assinatura['results']);

        return view('Gerenciamento.Assinatura.assinaturas', compact('assinatura'));
    }

    public function formularioPlanoAssinatura()
    {
        return view('Pay.MercadoPago.mercadoPagoPlanoDeAssinatura');
    }
}
