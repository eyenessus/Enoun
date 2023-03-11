<?php

namespace App\Http\Controllers;

use App\Models\Inicio;
use App\Models\Servico;
use App\Models\Slide;


class EnounDeletController extends Controller
{
    public function removerDoCarrinho($id)
    {
        $usuarioLogado = auth()->user();
        $usuarioLogado->servicosAsCar()->detach($id);
        return redirect('/carrinho');
    }

    public function deletarServico($id)
    {
        Servico::destroy($id);
       
        return redirect('/dashboard');
    }
    
    public function deletarNoticia($id)
    {
        Inicio::destroy($id);
        return redirect('/dashboard');
    }
    public function excluirSlide($id)
    {
        Slide::destroy($id);
        return redirect('/dashboard');
    }
    
}
