<?php
namespace App\Repositories;

use App\DTO\Produto\createProdutoDto;
use Illuminate\Support\Collection;
use stdClass;

interface ProdutoEnounInterface {
    public function getAll() : Collection;

    public function findOne(string $id) : stdClass | null;

    public function delete(string $id) : void;

    public function criarProduto(createProdutoDto $dto) : array | stdClass;

    public function atualizarProduto( string $id) : null | stdClass;

    public function buscarCategorias() : Collection;

    public function adicionarAoCarrinho(string $id) : bool | null ;

    public function buscarMeuProdutos() :array | null;

    public function removerDoCarrinho(string $id) : void;

    public function decrementarProduto(string $id) : null | bool;
}