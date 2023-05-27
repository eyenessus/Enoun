<?php

namespace App\Repositories\Produto;



use App\DTO\Produto\createProdutoDto;
use App\DTO\Produto\UpdateProdutoDTO;
use App\Http\Requests\Produto\UpdateProdutoRequest;
use App\Models\Categoria;
use App\Models\Produto;
use App\Repositories\Produto\ProdutoEnounInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use stdClass;


class ProdutoEloquentORM implements ProdutoEnounInterface
{
    public function __construct(protected Produto $model, protected Cache $cache)
    {
    }

    public function getAll(): Collection
    {
        $resultado = Cache::get('produtos', function () {
            return $this->model->all();
        });
        return collect($resultado);
    }

    public function findOne(string $id): Collection | null
    {
        if (!$produto = $this->model->findOrFail($id)) {
            return null;
        }
        return collect($produto);
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function criarProduto(createProdutoDto $dto): array | stdClass
    {
        $dto->user_id = Auth::user()->id;
        $dto->imagem = Storage::putFile('produtos', $dto->imagem);
        $produto = $this->model->create((array) $dto);
        return (object) $produto->toArray;
    }


    public function atualizarProduto(UpdateProdutoDTO $dto): null | stdClass
    {
        if (!$produto = $this->model->findOrFail($dto->id)) {
            return null;
        }

        Storage::delete($produto->imagem);
        $caminhoImagem = $dto->imagem = Storage::putFile('produtos', $dto->imagem);
        $produto['imagem'] = $caminhoImagem;
        $produto->update((array) $dto);
        return (object) $produto->toArray();
    }


    public function buscarCategorias(): Collection
    {
        $categorias = Categoria::all();
        return collect($categorias);
    }

    public function adicionarAoCarrinho(string $id): bool | null
    {

        $usuario = auth()->user();
        if (!$produto = $this->model->findOrFail($id)) {
            return null;
        }
        if ($usuario) {
            $carrinhoDeProdutos = $usuario->produtosCarrinho();
            $carrinhoDeProdutos->syncWithoutDetaching($produto->id);
            $carrinhoDeProdutos->where('carrinho_id', $produto->id)->increment('quantidade');
        }

        return true;
    }
    public function buscarMeuProdutos(): array | null
    {
        $usuario = auth()->user();
        if (!$usuario) {
            return null;
        }

        $produto = $usuario->produtosCarrinho;
        $total = $produto->sum(function ($produtos) {
            return $produtos->valor * $produtos->pivot->quantidade;
        });

        return ['produto' => collect($produto), 'totalProdutos' => $total];
    }

    public function removerDoCarrinho(string $id): void
    {
        $usuario = auth()->user();
        $usuario->produtosCarrinho()->detach($id);
    }

    public function decrementarProduto(string $id): null | bool
    {
        $usuario = auth()->user();
        if (!$produto = $this->model->findOrFail($id)) {
            return null;
        }
        if ($usuario) {
            $carrinhoDeProdutos = $usuario->produtosCarrinho();
            $carrinhoDeProdutos->syncWithoutDetaching($produto->id);
            $carrinhoDeProdutos->where('carrinho_id', $produto->id)->decrement('quantidade');
            $itemVazio =  $usuario->produtosCarrinho()->where('quantidade', '<', 1)->first();
            if ($itemVazio) {
                $carrinhoDeProdutos->detach($itemVazio->id);
            }
        }

        return true;
    }
}
