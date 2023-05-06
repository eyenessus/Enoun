<?php
namespace App\Services\Enoun;
use App\Repositories\Enoun\EnounInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
class EnounServices {
    public function __construct(
        protected EnounInterface $repository
    ){}

    public function buscar(string $search) : Collection
    {
        return $this->repository->buscar($search);
    }

    public function slides() : Collection
    {
       return $this->repository->slides();
    }
}
