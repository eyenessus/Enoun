<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Produto;
use App\Models\Servico;
use App\Models\Usuario;
use App\Models\Inicio;
class EnounController extends Controller
{
    public function Inicio(){
        //pagina inicial
        $inforday = Inicio::all();
        return view('Inicio.inicio',['inicio' => $inforday]);
    }

    public function Login(){
       return view('Login.login'); 
    }

    public function Cadastro()
    {
        return view('Cadastro.cadastro');
    }

    public function Contato(){
        return view('Contato.contato');
    }

    public function Servicos(){
        $services =  Servico::all();
    
        return view('Servicos.servicos',['serv'=>$services]);
    }

    public function Buscar()
    {
        $busca = request('search');
        return view('Busca.search',['idbusca'=>$busca]);
    }

    public function Cadastrar(Request $requisicao){
       
        Usuario::create($requisicao->all());
        return redirect('/')->with('mensagem', 'Cadastrado com sucesso!');
       
    }
}
