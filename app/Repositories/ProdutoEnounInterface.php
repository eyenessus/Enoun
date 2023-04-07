<?php
namespace App\Repositories;

use App\DTO\User\createProdutoDto;
use Illuminate\Support\Collection;
use stdClass;

interface ProdutoEnounInterface {
    public function getAll() : Collection;

    public function findOne(string $id) : stdClass | null;

    public function delete(string $id) : void;

    public function criarProduto(createProdutoDto $dto) : array | stdClass;

    public function atualizarProduto( string $id) : null | stdClass;

    public function buscarCategorias() : Collection;
}