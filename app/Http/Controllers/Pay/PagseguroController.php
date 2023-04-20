<?php
namespace App\Http\Controllers\Pay;
use App\Http\Controllers\Controller;
use App\Services\Pay\Pagseguro\PagseguroService;
use Illuminate\Http\Request;


class PagseguroController extends Controller
{
    public function __construct(protected PagseguroService $service)
    {
        
    }

    public function index()
    {
        return view('Pay.PagSeguro.pagSeguroCard');
    }

    public function cartaoCredito(Request $request)
    {
        $this->service->cartaoCredito($request);
    }

    public function boleto()
    {
        
        $this->service->boleto();
        return true;
    }
    public function pix()
    {
        $this->service->pix();
    }

    public function assinaturaDeRecorrenciaSubsequente()
    {
    }

    public function assinaturaDeRecorrenciaInital()
    {
    }

    public function receberNotificacoes(Request $request)
    {
        $this->service->receberNotificacoes($request);
    }
}
