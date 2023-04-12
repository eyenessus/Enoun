<?php
namespace App\Repositories\Produto;



use App\DTO\Produto\createProdutoDto;
use App\Models\Categoria;
use App\Models\Produto;
use App\Repositories\Produto\ProdutoEnounInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use stdClass;


class ProdutoEloquentORM implements ProdutoEnounInterface
{
    public function __construct(protected Produto $model)
    {
    }
    public function getAll(): Collection
    {
        $resultado = $this->model->all();
        return collect($resultado);
    }


    public function findOne(string $id): stdClass | null
    {
        if (!$produto = $this->model->findOrFail($id)) {
            return null;
        }
        return (object) $produto;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }



    public function criarProduto(createProdutoDto $dto): array | stdClass
    {
        $dto->imagem = Storage::putFile('produtos', $dto->imagem);
        $produto = $this->model->create((array) $dto);
        return (object) $produto->toArray;
    }



    public function atualizarProduto(string $id): null | stdClass
    {
        if (!$produto = $this->model->findOrFail($id)) {
            return null;
        }
        return (object) $this->model->update($produto);
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
            $carrinhoDeProdutos = $usuario->produtosComCarrinho();
            $carrinhoDeProdutos->syncWithoutDetaching($produto->id);
            $carrinhoDeProdutos->where('id', $id)->increment('quantidade');
        }

        return true;
    }
    public function buscarMeuProdutos(): array | null
    {
        $usuario = Auth::user();
        if (!$usuario) {
            return null;
        }

        $produto = $usuario->produtosComCarrinho;
        $total = $produto->sum(function ($produtos) {
            return $produtos->valor * $produtos->pivot->quantidade;
        });

        return ['produto' => collect($produto), 'totalProdutos' => $total];
    }


    public function removerDoCarrinho(string $id): void
    {
        $usuario = auth()->user();
        $usuario->produtosComCarrinho()->detach($id);
    }


    public function decrementarProduto(string $id): null | bool
    {
        $usuario = auth()->user();
        if (!$produto = $this->model->findOrFail($id)) {
            return null;
        }
        if ($usuario) {
            $carrinhoDeProdutos = $usuario->produtosComCarrinho();
            $carrinhoDeProdutos->syncWithoutDetaching($produto->id);
            $carrinhoDeProdutos->where('id', $id)->decrement('quantidade');
        }

        $produtosSemQuantidade = auth()->user()->produtosComCarrinho()->where('quantidade', '<', 1)->get()->toArray();
        foreach($produtosSemQuantidade as $servicoNull) {
         $usuario->produtosComCarrinho()->detach($servicoNull['id']);
         }
        return true;
    }
}
