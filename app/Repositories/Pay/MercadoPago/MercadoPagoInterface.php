<?php
namespace App\Repositories\Pay\MercadoPago;

use Illuminate\Http\Request;

interface MercadoPagoInterface
{
    public function buscarItensCarrinho() : array;

    public function buscarDadosCliente(): array;

    public function notificacoesMercadoPago(Request $request);
}