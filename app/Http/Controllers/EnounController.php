<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrinho;
use App\Models\Servico;
use App\Services\Enoun\EnounServices;
use App\Services\Pay\MercadoPago\MercadoPagoService;
use App\Services\User\UserEnounService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\VarDumper\VarDumper;

class EnounController extends Controller
{
    public function __construct(
        protected UserEnounService $service,
        protected EnounServices $enounServices,
        protected MercadoPagoService $mercadoService
    ) {
    }
    public function index(): View
    {
        $slide = $this->enounServices->slides();
        $plano = $this->mercadoService->buscarTodosPlanosDeAssinatura();
        $plano = collect($plano['results']);
        return view('welcome', compact('slide', 'plano'));
    }

    public function sobre(): View
    {
        return view('Sobre.sobre');
    }

    public function formCategoria(): View
    {
        return view('Cadastro.categoria');
    }

    public function dashboard(): View
    {
        $prodServices = $this->service->meusRegistros();
        return view('Dashboard.dashboard', ['registros' => $prodServices]);
    }

    public function buscar(Request $request): View
    {
        $busca = $this->enounServices->buscar($request->search);
        return view('buscaFiltroPaginaInicial', compact('busca'));
    }
}
