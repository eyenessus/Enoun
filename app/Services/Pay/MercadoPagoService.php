<?php
namespace App\Services\Pay;

use App\Repositories\Pay\MercadoPago\MercadoPagoInterface;

class MercadoPagoService
{
    public function __construct(protected MercadoPagoInterface $repository){}
    
}