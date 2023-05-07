<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Slide;
use App\Services\Enoun\EnounServices;
use App\Services\Pay\MercadoPago\MercadoPagoService;
use App\Services\Produto\ProdutoEnounService;
use App\Services\User\UserEnounService;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        return view('welcome', compact('slide','plano'));
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

    public function buscar(Request $request)
    {
        $busca = $this->enounServices->buscar($request->search);
        return view('buscaFiltroPaginaInicial', compact('busca'));
    }
}
