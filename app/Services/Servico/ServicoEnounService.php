<?php
namespace App\Services\Servico;

use App\DTO\Servico\CreateServicoDTO;
use App\Repositories\Servico\ServicoEnounInterface;
use Illuminate\Support\Collection;
use stdClass;

class ServicoEnounService {

    public function __construct(protected ServicoEnounInterface $repository)
    { }

    

    public function getAll() : Collection
    {
        return $this->repository->getAll();
    }

    
    public function findOne(string $id) : stdClass | null
    {
       return $this->repository->findOne($id);
    }



    public function delete(string $id) : void
    {
        $this->repository->delete($id);
    }


    public function createServico(CreateServicoDTO $dto) : stdClass | array
    {
        return $this->repository->createServico($dto);
    }


    public function atualizarProduto( string $id) : null | stdClass
    {
        return $this->repository->atualizarProduto($id);
    }


    public function buscarCategorias() : Collection
    {
        return $this->repository->buscarCategorias();
    }


}