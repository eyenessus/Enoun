<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Inicio;
use App\Models\Pedido;
use App\Models\Servico;
use App\Models\Slide;
use App\Models\Usuario;
use Illuminate\Http\Request;

class EnounPostController extends Controller
{
    public function cadastrarUsuario(Request $requisicao)
    {
        Usuario::create($requisicao->all());
        return redirect('/')->with('mensagem', 'Cadastrado com sucesso!');
    }

    public function registrarNoticia(Request $request)
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

    public function registrarServico(Request $request)
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

    public function enviarMensagem(Request $request)
    {
        
        return redirect('/')->with('contato', 'Mensagem enviada com sucesso!');
    }

    public function adicionarAoCarrinho($id)
    {
        $usuarioLogado = auth()->user();
        
        $usuarioLogado->servicosAsCar()->syncWithoutDetaching($id);
        
        return redirect('/carrinho');
    }
    
    public function registroSlide(Request $request)
    {
        $autenticado = auth()->user();
        $slide = new Slide();
        $slide->titulo = $request->titulo;
        $slide->descricao = $request->descricao;
        
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requisaoImagem = $request->imagem;
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/slides'), $nomeImagem);
            $slide->imagem = $nomeImagem;
        }
        $slide->user_id = $autenticado->id;
        $slide->save();
        return redirect('/');
    }

    public function finalizarPedido()
    {   
        $usuarioLogado = auth()->user();
        $carrinho = $usuarioLogado->servicosAsCar;
        
        $localearray = [];
        for ($i = 0; $i < count($carrinho); $i++) {
            
            
            array_push($localearray, $carrinho[$i]->pivot['quantidade'] . ' ' . $carrinho[$i]['nome']);
        }
        
        
        $valorFinal = $usuarioLogado->servicosAsCar->where('preco')->sum('preco');
        //soma do valor do carrinho
        $model = new Pedido();
        $model->user_id = $usuarioLogado->id;
        $model->descricao = $localearray;
        $model->valor = $valorFinal;
        $model->save();
        
        $buscaDoID = Pedido::orderBy('id', 'desc')->first();
        //busca do ultimo id a da lista de pedidos
        
        
        $usuarioLogado->pedidosAsWith()->attach($buscaDoID);
        
        $usuarioLogado->servicosAsCar()->detach(); //limpa items do carrinho
        
        return redirect('/exibirPedidos');
    }
}
