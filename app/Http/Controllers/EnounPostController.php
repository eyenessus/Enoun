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
        $obterUser = auth()->user();
        $data = $request->all();
        $data['user_id'] = $obterUser->id;

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requisaoImagem = $request->imagem;
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/publicnoticias'), $nomeImagem);
            $data['imagem'] = $nomeImagem;
        }
        Inicio::create($data);
        
        return redirect('/');
    }

    public function registrarServico(Request $request)
    {
        $usuarioLogado = auth()->user();
        $data = $request->all();
        $data['user_id'] = $usuarioLogado->id;
        //imagem
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requisaoImagem = $request->imagem;
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/publicserivces'), $nomeImagem);
            $data['imagem'] = $nomeImagem;
        }
        Servico::create($data);
        return redirect('/');
    }

    public function enviarMensagem(Request $request)
    {
        Contato::create($request->all());
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
        $data = $request->all();
        $data['user_id'] = $autenticado->id;
        
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requisaoImagem = $request->imagem;
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/slides'), $nomeImagem);
            $data['imagem'] = $nomeImagem;
        }
        Slide::create($data);
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
        
        $valorFinal = $carrinho->where('preco')->sum('preco');
        //soma do valor do carrinho
        $model = new Pedido;
        $model->user_id = $usuarioLogado->id;
        $model->descricao = $localearray;
        $model->valor = $valorFinal;
        $model->save();
        $model->refresh();

        $buscaDoID = $model::orderBy('id', 'desc')->first();
        //busca do ultimo id a da lista de pedidos
        
        $usuarioLogado->pedidosAsWith()->attach($buscaDoID);
        
        $usuarioLogado->servicosAsCar()->detach(); //limpa items do carrinho
        
        return redirect('/exibirPedidos');
    }
}
