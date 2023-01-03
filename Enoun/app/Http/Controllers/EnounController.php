<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Produto;
use App\Models\Servico;
use App\Models\Usuario;
class EnounController extends Controller
{
    public function Inicio(){
        //pagina inicial
        return view('Inicio.inicio');
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
        return view('Busca.search');
    }

    public function Cadastrar(Request $requisicao){
       
        Usuario::create($requisicao->all());
        return view('Inicio.inicio');
       
    }
}
