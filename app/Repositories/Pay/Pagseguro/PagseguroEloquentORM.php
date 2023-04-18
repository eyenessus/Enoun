<?php
namespace App\Repositories\Pay\Pagseguro;
use App\Models\Pedido;
class PagseguroEloquentORM implements PagseguroInterface
{
    public function __construct(protected Pedido $model){}
    
}