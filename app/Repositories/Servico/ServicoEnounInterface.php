<?php
namespace App\Repositories\Servico;
use App\DTO\Servico\CreateServicoDTO;
use Illuminate\Support\Collection;
use stdClass;

interface ServicoEnounInterface {


    public function getAll() : Collection;

    public function findOne(string $id) : stdClass | null;
    
    public function delete(string $id) : void;

    public function createServico(CreateServicoDTO $dto) : stdClass | array;

    public function atualizarProduto( string $id) : null | stdClass;

    public function buscarCategorias() : Collection;
}