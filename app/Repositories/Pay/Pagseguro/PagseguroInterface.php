<?php
namespace App\Repositories\Pay\Pagseguro;
use Illuminate\Http\Request;
interface PagseguroInterface
{
    public function receberNotificacoes(Request $request);
}