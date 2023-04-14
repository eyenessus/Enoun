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

    
    public function findOne(string $id) : Collection | null
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
        return $this->repository->atualizarServico($id);
    }


    public function buscarCategorias() : Collection
    {
        return $this->repository->buscarCategorias();
    }

    public function adicionarAoCarrinho(string $id): bool | null 
    {
        
        return $this->repository->adicionarAoCarrinho($id);
    }

    public function buscarMeusServicos() : array | null
    {
        return $this->repository->buscarMeusServicos();
     }

     public function removerDoCarrinho(string $id) : void
     {
         $this->repository->removerDoCarrinho($id);
     }

     public function decrementarDoCarrinho(string $id) : void
     {
        $this->repository->decrementarServico($id);
     }

}