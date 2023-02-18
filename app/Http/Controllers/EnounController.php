<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Produto;
use App\Models\Servico;
use App\Models\Usuario;
use App\Models\Inicio;
use App\Models\Contato;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Error\Notice;

class EnounController extends Controller
{
    public function index()
    {
        //pagina inicial
        $inforday = Inicio::all();
        return view(
            'Inicio.inicio',
            ['inicio' => $inforday, 'slides' => $inforday]
        );
    }

    public function Login()
    {

        return view('Login.login');
    }

    public function create()
    {
        return view('Cadastro.cadastro');
    }

    public function Contato()
    {
        return view('Contato.contato');
    }

    public function Servicos()
    {
        $services =  Servico::all();
        return view('Servicos.servicos', ['serv' => $services]);
    }

    public function Buscar()
    {
        $busca = request('pesquisa');
        if ($busca) {
            $servicosBusca = Servico::where([['nome', 'like', '%' . $busca . '%']])->get();
        } else {
            $servicosBusca = Servico::all();
        }
        return view('Busca.search', ['idbusca' => $busca, 'services' => $servicosBusca]);
    }

    public function store(Request $requisicao)
    {
        Usuario::create($requisicao->all());
        return redirect('/')->with('mensagem', 'Cadastrado com sucesso!');
    }

    public function RService()
    {
        return view('Registro.service');
    }

    public function RNoti()
    {
        return view('Registro.noticiasini');
    }
    public function SaveNoticia(Request $request)
    {

        $noticias = new Inicio;
        $noticias->titulo = $request->titulo;
        $noticias->descricao = $request->descricao;
        //imagem
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requisaoImagem = $request->imagem;
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/publicnoticias'), $nomeImagem);
            $noticias->imagem = $nomeImagem;
        }

        $obterUser = auth()->user();
        $noticias->user_id = $obterUser->id;
        $noticias->save();

        return redirect('/');
    }
    public function SaveService(Request $request)
    {
        $service = new Servico;
        $service->nome = $request->nome;
        $service->descricao = $request->descricao;
        $service->categoria = $request->categoria;
        $service->codigo = $request->codigo;
        $service->inforextra = $request->inforextra;
        $service->preco = $request->preco;

        //imagem
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requisaoImagem = $request->imagem;
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/publicserivces'), $nomeImagem);
            $service->imagem = $nomeImagem;
        }


        $usuarioLogado = auth()->user(); //usuario logado
        $service->user_id = $usuarioLogado->id; //atribuindo o id do usuario logado no data base
        $service->save();

        return redirect('/');
    }

    public function show($id)
    {
        $servico = Servico::findOrFail($id); //filtro de registros
        $donoDoServico = User::where('id', $servico->user_id)->first()->toArray();

        return view('Servicos.resultado', ['resultadoId' => $servico, 'donoDoServico' => $donoDoServico]);
    }


    public function showNoticias($id)
    {
        $resultado = Inicio::findOrFail($id);
        $buscaFilttrada = User::where('id', $resultado->user_id)->first()->toArray();
        return view('Inicio.resultado', ['resultadoNoticia' => $resultado, 'buscaFilttrada' => $buscaFilttrada]);
    }

    public function MessContats(Request $request)
    {
        $contatos = new Contato();
        $contatos->usuario = $request->usuario;
        $contatos->mensagem = $request->mensagem;
        $contatos->save();
        return redirect('/')->with('contato', 'Mensagem enviada com sucesso!');
    }

    public function Dash()
    {
        $usuarioLogado = auth()->user();
        $servico = $usuarioLogado->servicos;
        $noticias = $usuarioLogado->noticias;

        return view('dashboard', ['servico' => $servico, 'noticias' => $noticias]);
    }

    public function destroy($id)
    {

        Servico::FindOrFail($id)->delete();
        return redirect('/');
    }

    public function destroyeNotice($id)
    {

        Inicio::FindOrFail($id)->delete();
        return redirect('/');
    }
    public function visualizacao($id)
    {
        $servico = Servico::FindOrFail($id);
        return view('Edition.visualizacao', ['servico' => $servico]);
    }

    public function editar($id)
    {
        $servico = Servico::FindOrFail($id);
        return view('Edition.edition', ['servico' => $servico]);
    }

    public function update(Request $request)
    {

        $data = $request->all();

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requisaoImagem = $request->imagem;
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/publicserivces'), $nomeImagem);
            $data['imagem'] = $nomeImagem;
        }

        Servico::findOrFail($request->id)->update($data);
        return redirect('/');
    }


    public function visualizarNoticia($id)
    {
        $noticia = Inicio::FindOrFail($id);
        return view('Edition.noticiaVisu', ['noticia' => $noticia]);
    }

    public function editarNoticia($id)
    {
        $noticia = Inicio::FindOrFail($id);
        return view('Edition.noticiaEdit', ['noticia' => $noticia]);
    }

    public function atualizarNoticia(Request $request)
    {

        $data = $request->all();

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requisaoImagem = $request->imagem;
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/publicnoticias'), $nomeImagem);
            $data['imagem'] = $nomeImagem;
        }

        Inicio::findOrFail($request->id)->update($data);
        return redirect('/');
    }


    public function carrinho()
    {


        $google = Servico::all();
        if (auth()) {
            $user = auth()->user();
            $addItem = $user->servicosAsCar;
        } else {
            $addItem = null;
            return redirect('/');
        }

        return view('Car.carrinho', ['addItem' => $addItem]);
    }


    public function addCarrinho($id)
    {
        $usuarioLogado = auth()->user();
        $usuarioLogado->servicosAsCar()->attach($id, ['quantidade' => 1]);

        return redirect('/carrinho');
    }

    public function removeCarr($id)
    {
        $usuarioLogado = auth()->user();
        $usuarioLogado->servicosAsCar()->detach($id);


        return redirect('/carrinho');
    }

    public function verPedidos()
    {
        $user = auth()->user();
        $pedidos = $user->pedidos;
        $item = $user->pedidosAswi;
    
        return view('Car.pedidoRe', ['pedidos' => $pedidos, 'item'=> $item]);
    }


    public function finalizarPedido()
    {
        $usuario = auth()->user();
     
        //inserção de pagamento
        $datePagamento =
            [
                'user_id' => $usuario->id,
                'pagamento' => true,
            ];
        Pedido::create($datePagamento);

        $buscaDoID = Pedido::orderBy('id', 'desc')->first();
        //busca do ultimo id a fazer o pedido


        //registro de pedido valores e descricao
        $valorFinal =  $usuario->servicosAsCar->where('preco')->sum('preco'); //soma do valor do carrinho


        $buscaDescricao =  $usuario->servicosAsCar;

        $usuario->pedidosAswi()->attach($buscaDoID->id, ['servicos_identificao' => $buscaDescricao, 'valor' => $valorFinal]);
        $usuario->servicosAsCar()->detach(); //limpa items do carrinho

        return redirect('/pedidosFeito');
    }
}
