<?php

namespace App\Http\Controllers;

use App\Models\Inicio;
use App\Models\Servico;


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
        Servico::FindOrFail($id)->delete();
        return redirect('/');
    }
    
    public function deletarNoticia($id)
    {
        Inicio::FindOrFail($id)->delete();
        return redirect('/');
    }

    
}
