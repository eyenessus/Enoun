<?php
namespace App\Repositories\Servico;
use App\DTO\Servico\CreateServicoDTO;
use App\Models\Categoria;
use App\Models\Servico;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use stdClass;

class ServicoEloquentORM implements ServicoEnounInterface {

    public function __construct(protected Servico $model){}


    public function getAll(): Collection
    {
        $servicos = $this->model->all();
        return collect($servicos);
    }
    

    public function findOne(string $id): stdClass | null
    {
        if(!$servicoEncontrado = $this->model->findOrFail($id))
        {
            return null;
        }
        return (object) $servicoEncontrado;
        
    }


    public function delete(string $id) : void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function createServico(CreateServicoDTO $dto) : stdClass | array
    {
        $dto->imagem = Storage::putFile('servicos', $dto->imagem);
        $servico = $this->model->create((array) $dto);
        return (object) $servico->toArray();
        
    }

    public function atualizarProduto( string $id) : null | stdClass
    {
        if(!$servico = $this->model->findOrFail($id))
        {
            return null;
        }

        return (object) $servico->toArray();
    }

    public function buscarCategorias() : Collection
    {
        $categoria = Categoria::all();

        return collect($categoria);

    }
}