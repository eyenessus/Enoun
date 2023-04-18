<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class PagseguroController extends Controller
{
    public function index()
    {
        return view('Pay.PagSeguro.pagSeguroCard');
    }

    public function cartaoCredito(Request $request)
    {
        
    }
 
    public function boleto()
    {
    
    }
    public function pix()
    {
      
    }

    public function assinaturaDeRecorrenciaSubsequente()
    {
   
    }

    public function assinaturaDeRecorrenciaInital()
    {
      
    }

    public function receberNotificacoes(Request $request)
    {
       
        }
    }
}
