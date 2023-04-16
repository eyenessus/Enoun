<?php
namespace App\Repositories\Pay\MercadoPago;
use Illuminate\Support\Collection;

interface MercadoPagoInterface
{
    public function buscarItensCarrinho() : array;

    public function buscarDadosCliente(): array;
}