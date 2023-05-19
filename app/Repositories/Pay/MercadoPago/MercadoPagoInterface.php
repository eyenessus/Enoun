<?php
namespace App\Repositories\Pay\MercadoPago;

use App\Repositories\Pay\MercadoPago\PaginateInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use stdClass;

interface MercadoPagoInterface
{
    public function buscarItensCarrinho() : array;

    public function buscarDadosCliente():  Collection;

    public function notificacoesMercadoPago(Request $request);

}