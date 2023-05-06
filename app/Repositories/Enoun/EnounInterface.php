<?php
namespace App\Repositories\Enoun;


use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface EnounInterface
{
    public function buscar(string $search) : Collection;
    public function slides() : Collection;

}