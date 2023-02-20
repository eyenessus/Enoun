<?php

namespace App\Http\Controllers;

use App\Models\Inicio;
use App\Models\Servico;
use Illuminate\Http\Request;

class EnounPutController extends Controller
{
    public function editarServico(Request $request)
    {
        
        $data = $request->all();
        
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requisaoImagem = $data['imagem'];
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/publicserivces'), $nomeImagem);
            $data['imagem'] = $nomeImagem;
        }
        
        Servico::findOrFail($request->id)->update($data);
        return redirect('/');
    }

    public function editarNoticia(Request $request)
    {
        
        $data = $request->all();
        
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requisaoImagem = $data['imagem'];
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/publicnoticias'), $nomeImagem);
            $data['imagem'] = $nomeImagem;
        }
        dd($request->id);
        Inicio::findOrFail($request->id)->update($data);
        return redirect('/');
    }

    
}
