<?php

namespace App\Http\Controllers;

use App\Models\Inicio;
use App\Models\Pedido;
use App\Models\Servico;
use App\Models\Slide;
use App\Models\User;



class EnounController extends Controller
{
    public function index()
    {
        //pagina inicial
        $inforday = Slide::all();
        $noticias = Inicio::all();
        if(auth()){
            $user = auth()->user();
        }
        
        return view(
            'Inicio.inicio',
            ['inicio' => $noticias, 'slides' => $inforday,'user' => $user]
        );
    }

    public function login()
    {
        return view('Login.login');
    }

    public function create()
    {
        return view('Cadastro.cadastro');
    }
    public function contato()
    {
        return view('Contato.contato');
    }

    public function servicos()
    {
        $services = Servico::all();
        return view('Servicos.servicos', ['serv' => $services]);
    }

    public function exibirServico($id)
    {
        $servico = Servico::findOrFail($id); //filtro de registros
        $donoDoServico = User::where('id', $servico->user_id)->first()->toArray();
        return view('Servicos.resultadoServico', ['resultadoId' => $servico, 'donoDoServico' => $donoDoServico]);
    }

    public function exbirNoticia($id)
    {
        $noticia = Inicio::findOrFail($id);
        $autorNoticia = User::where('id', $noticia->user_id)->first()->toArray();
        return view('Inicio.resultado', ['resultadoNoticia' => $noticia, 'autor' => $autorNoticia]);
    }

    public function search()
    {
        $busca = request('pesquisa');
        if ($busca) {
            $servicosBusca = Servico::where([['nome', 'like', '%' . $busca . '%']])->get();
        } else {
            $servicosBusca = Servico::all();
        }
        return view('Busca.search', ['idbusca' => $busca, 'services' => $servicosBusca]);
    }

    //DASHBOARD
    public function dashboard()
    {
        $usuarioLogado = auth()->user();
        $servico = $usuarioLogado->servicos;
        $noticias = $usuarioLogado->noticias;
        $slide = $usuarioLogado->slides;
        return view('dashboard', ['servico' => $servico, 'noticias' => $noticias, 'slides' => $slide]);
    }
    public function exibirNoticiaDash($id)
    {
        $noticia = Inicio::FindOrFail($id);
        return view('Edition.noticiaVisu', ['noticia' => $noticia]);
    }

    public function exibirServicoDash($id)
    {
        $servico = Servico::FindOrFail($id);
        return view('Edition.servicoVisu', ['servico' => $servico]);
    }

    //CARRINHO E PEDIDOS
    public function exibirCarrinho()
    {
        
        if (auth()) {
            $user = auth()->user();

            $itemSemQuantidade = $user->servicosAsCar()->where('quantidade', '<', 1)->get()->toArray();

            foreach ($itemSemQuantidade as $item) 
            {
                $user->servicosAsCar()->detach($item['id']);
            }

            
            $carrinho = $user->servicosAsCar;
            $valorFinal = 0;
            foreach ($carrinho as $valor) {
                $valorFinal += $valor['preco'] * $valor->pivot['quantidade'];
            }

            $addItem = $user->servicosAsCar()->simplepaginate(5);
        } 
        else {
            $addItem = null;
            return redirect('/');
        }


        return view('Car.carrinho', ['addItem' => $addItem,'valorFinal' => $valorFinal]);
    }

    public function verPedidos()
    {
        $usuarioLogado = auth()->user();
        $listaDePedidos = $usuarioLogado->pedidosAsWith()->orderBy('id', 'desc')->simplePaginate(4);
        
        return view('Car.pedidoRe', ['listaDePedidos' => $listaDePedidos]);
    }


    //FORMS
    public function formEditNoticia($id)
    {
        $noticia = Inicio::FindOrFail($id);
        return view('Edition.noticiaEdit', ['noticia' => $noticia]);
    }

    public function formSlides()
    {
        return view('Registro.slides');
    }

    public function formEditServico($id)
    {
        $servico = Servico::FindOrFail($id);
        return view('Edition.servicoEdit', ['servico' => $servico]);
    }

    public function formServico()
    {
        return view('Registro.servico');
    }

    public function formNoticia()
    {
        return view('Registro.noticia');
    }

    public function exibirSlide($id){
        $slide = Slide::FindOrFail($id);

        return view('Edition.slideview',['slide' => $slide]);
    }

    
    public function formEditSlide($id)
    {
        $slide = Slide::FindOrFail($id);
        return view('Edition.slideFormEdit', ['slide' => $slide]);
    }

    public function obterInfor(){
        $usuarioLogado = auth()->user();
        $listaDePedidos = Pedido::all();
        $filtro = $listaDePedidos->where('user_id', $usuarioLogado->id);
    
        return response()->json($filtro);
    }

}
