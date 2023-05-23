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
   
        //adiciondo serviço dentro do carrinho polimorfico

        //usuario autenticado; 
        $user = auth()->user();

        //acessar a tabelaPIVOT
        $item = $user->servicosCarrinho();

        $item->syncWithoutDetaching([1]); //adicionando serviço especifico na tabela PIVOT
        $item->where('carrinho_id',1)->increment('quantidade'); //incrementação de quantidade DEFAULT (0)

        $item->where('carrinho_id',1)->decrement('quantidade'); //decrementação de quantidade 

       //busca todos itens de serviço do carrinho
        $itensCarrinho = $user->servicosCarrinho;
         echo($itensCarrinho);
    
         //deletar serviço especfico do carrinho
        $user->servicosCarrinho()->detach(1);
     

        $servico = Servico::find(1);
         echo($servico->usuarios);

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
