<?php
namespace App\Services\Pay\Pagseguro;

use App\Repositories\Pay\Pagseguro\PagseguroInterface;

class PagseguroService
{
    public function __construct(protected PagseguroInterface $respository)
    {}
}