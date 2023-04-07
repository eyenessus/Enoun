<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Produto;

class EnounController extends Controller
{
 
    public function index()
    {
        
       
        return view('welcome');
    }

    public function sobre(){
        return view('Sobre.sobre');
    }
 
    public function formCategoria(){
        return view('Cadastro.categoria');
    }
 
}
