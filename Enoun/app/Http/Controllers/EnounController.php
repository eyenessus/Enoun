<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Produto;

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
        return view('Servicos.servicos');
    }

    public function Buscar(Request $request)
    {
        $request->query();
        return view('Busca.search',['id'=>$request]);
    }
}
