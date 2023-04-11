<?php

namespace App\Repositories;

use App\DTO\Produto\createProdutoDto;
use App\Models\Categoria;
use Illuminate\Support\Collection;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use stdClass;
class ProdutoEloquentORM implements ProdutoEnounInterface
{
    public function __construct(protected Produto $model)
    { }

    public function getAll(): Collection
    {
        $resultado =$this->model->all();
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
       
        $dto->imagem = Storage::putFile('produtos',$dto->imagem);

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


    public function buscarCategorias() : Collection
    {
        $categorias = Categoria::all();
        return collect($categorias);
    }


    public function adicionarAoCarrinho(string $id) : null | Collection
    {
    
        if(!$produto = $this->model->findOrFail($id)){
            return null;
        }

        $carrinhoDeProdutos = Auth::user()->produtosComCarrinho();
        $carrinhoDeProdutos->syncWithoutDetaching($produto->id);
        $carrinhoDeProdutos->where('id', $id)->increment('quantidade');

        return collect($carrinhoDeProdutos) ;

    }
    public function buscarMeuProdutos() : Collection
    {
      
        $produtos = Auth::user()->produtosComCarrinho;
       
     
        return collect($produtos);

    }
   
}
