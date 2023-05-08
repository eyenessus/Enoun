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
      $boleto =  $this->service->boleto();
        return redirect($boleto);
    }
    public function pix()
    {
        $pix = $this->service->pix();
        return view('Pay.PagSeguro.pixPagSeguro',compact('pix'));
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
