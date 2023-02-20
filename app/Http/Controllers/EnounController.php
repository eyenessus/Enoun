<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Servico;
use App\Models\Usuario;
use App\Models\Inicio;
use App\Models\Contato;


class EnounController extends Controller
{
    public function index()
    {
        //pagina inicial
        $inforday = Slide::all();
        $noticias = Inicio::all();
        return view(
            'Inicio.inicio',
            ['inicio' => $noticias, 'slides' => $inforday]
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

    public function formServico()
    {
        return view('Registro.service');
    }

    public function formNoticia()
    {
        return view('Registro.noticiasini');
    }



    public function exibirServico($id)
    {
        $servico = Servico::findOrFail($id); //filtro de registros
        $donoDoServico = User::where('id', $servico->user_id)->first()->toArray();
        return view('Servicos.resultado', ['resultadoId' => $servico, 'donoDoServico' => $donoDoServico]);
    }


    public function exbirNoticia($id)
    {
        $resultado = Inicio::findOrFail($id);
        $buscaFilttrada = User::where('id', $resultado->user_id)->first()->toArray();
        return view('Inicio.resultado', ['resultadoNoticia' => $resultado, 'buscaFilttrada' => $buscaFilttrada]);
    }

    public function dashboard()
    {
        $usuarioLogado = auth()->user();
        $servico = $usuarioLogado->servicos;
        $noticias = $usuarioLogado->noticias;
        $slide = $usuarioLogado->slides;
        return view('dashboard', ['servico' => $servico, 'noticias' => $noticias, 'slides' => $slide]);
    }


    public function exibirServicoDash($id)
    {
        $servico = Servico::FindOrFail($id);
        return view('Edition.visualizacao', ['servico' => $servico]);
    }

    public function formEditServico($id)
    {
        $servico = Servico::FindOrFail($id);
        return view('Edition.edition', ['servico' => $servico]);
    }




    public function exibirNoticiaDash($id)
    {
        $noticia = Inicio::FindOrFail($id);
        return view('Edition.noticiaVisu', ['noticia' => $noticia]);
    }

    public function formEditNoticia($id)
    {
        $noticia = Inicio::FindOrFail($id);
        return view('Edition.noticiaEdit', ['noticia' => $noticia]);
    }




    public function exibirCarrinho()
    {

        if (auth()) {
            $user = auth()->user();
            $addItem = $user->servicosAsCar()->simplepaginate(5);
        } else {
            $addItem = null;
            return redirect('/');
        }



        return view('Car.carrinho', ['addItem' => $addItem]);
    }






    public function verPedidos()
    {
        $usuarioLogado = auth()->user();

        $item = $usuarioLogado->pedidosAsWith()->orderBy('id', 'desc')->simplePaginate(4);;

        $teste = $item;


        return view('Car.pedidoRe', ['item' => $item, 'teste' => $teste]);
    }

    public function formSlides()
    {
        return view('Registro.slides');
    }
}
