<?php
namespace App\Repositories\Pay\MercadoPago;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface MercadoPagoInterface
{
    public function buscarItensCarrinho() : array;

    public function buscarDadosCliente():  Collection;

    public function notificacoesMercadoPago(Request $request);
}