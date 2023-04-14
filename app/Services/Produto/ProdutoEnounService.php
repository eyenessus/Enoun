<?php

namespace App\Services\Produto;

use App\DTO\Produto\createProdutoDto;
use App\DTO\Produto\UpdateProdutoDTO;
use App\Http\Requests\Produto\UpdateProdutoRequest;
use App\Repositories\Produto\ProdutoEnounInterface;
use Illuminate\Support\Collection;
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

    public function findOne(string $id): Collection | null
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


    public function update(UpdateProdutoDTO $dto): array | stdClass
    {
        
        return $this->repository->atualizarProduto($dto);
    }

    public function buscarCategorias(): Collection
    {
        return $this->repository->buscarCategorias();
    }

    public function adicionarAoCarrinho(string $id): bool | null
    {

        return $this->repository->adicionarAoCarrinho($id);
    }

    public function buscarMeuProdutos(): array | null
    {
        return $this->repository->buscarMeuProdutos();
    }

    public function removerDoCarrinho(string $id): void
    {
        $this->repository->removerDoCarrinho($id);
    }

    public function decrementarDoCarrinho(string $id): void
    {
        $this->repository->decrementarProduto($id);
    }
}
