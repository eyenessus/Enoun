<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Slide;
use App\Services\Produto\ProdutoEnounService;
use App\Services\User\UserEnounService;
use Illuminate\View\View;

class EnounController extends Controller
{
 public function __construct(protected UserEnounService $service){}
    public function index() : View
    {
        $slide = Slide::all();
        return view('welcome', compact('slide'));
    }

    public function sobre() : View
    {
        return view('Sobre.sobre');
    }
 
    public function formCategoria() : View
    {
        return view('Cadastro.categoria');
    }

    public function dashboard() : View
    {
        $prodServices=$this->service->meusRegistros();
        return view('Dashboard.dashboard',['registros'=>$prodServices]);
    }

 
}
