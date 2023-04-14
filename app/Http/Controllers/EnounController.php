<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\View\View;

class EnounController extends Controller
{
 
    public function index() : View
    {
        return view('welcome');
    }

    public function sobre() : View
    {
        return view('Sobre.sobre');
    }
 
    public function formCategoria() : View
    {
        return view('Cadastro.categoria');
    }
 
}
