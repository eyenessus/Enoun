<?php

namespace App\Services\Produto;

use App\DTO\Produto\createProdutoDto;
use App\Repositories\ProdutoEnounInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ProdutoEnounService
{
    public function __construct(protected ProdutoEnounInterface $repository)
    {
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function findOne(string $id): stdClass | null
    {
        return $this->repository->findOne($id);
    }


    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }


    public function criarProduto(createProdutoDto $dto): array | stdClass
    {
        return (object) $this->repository->criarProduto($dto);
    }


    public function atualizarProduto(string $id): array | stdClass
    {
        return $this->repository->atualizarProduto($id);
    }

    public function buscarCategorias(): Collection
    {
        return $this->repository->buscarCategorias();
    }

    public function adicionarAoCarrinho(string $id): null | Collection
    {
        
        return $this->repository->adicionarAoCarrinho($id);
    }

    public function buscarMeuProdutos() : Collection
    {
        return $this->repository->buscarMeuProdutos();
     }
}
