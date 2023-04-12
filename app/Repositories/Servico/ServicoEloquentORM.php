<?php

namespace App\Repositories\Servico;

use App\DTO\Servico\CreateServicoDTO;
use App\Models\Categoria;
use App\Models\Servico;
use App\Repositories\Servico\ServicoEnounInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use stdClass;

class ServicoEloquentORM implements ServicoEnounInterface
{

    public function __construct(protected Servico $model)
    {
    }


    public function getAll(): Collection
    {
        $servicos = $this->model->all();
        return collect($servicos);
    }


    public function findOne(string $id): stdClass | null
    {
        if (!$servicoEncontrado = $this->model->findOrFail($id)) {
            return null;
        }
        return (object) $servicoEncontrado;
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function createServico(CreateServicoDTO $dto): stdClass | array
    {
        $dto->imagem = Storage::putFile('servicos', $dto->imagem);
        $servico = $this->model->create((array) $dto);
        return (object) $servico->toArray();
    }

    public function atualizarservico(string $id): null | stdClass
    {
        if (!$servico = $this->model->findOrFail($id)) {
            return null;
        }
        return (object) $servico->toArray();
    }


    public function buscarCategorias(): Collection
    {
        $categoria = Categoria::all();
        return collect($categoria);
    }


    public function adicionarAoCarrinho(string $id): bool | null
    {
        $usuario = auth()->user();

        if (!$servico = $this->model->findOrFail($id)) {
            return null;
        }
        if ($usuario) {
            $carrinhoDeservicos = $usuario->servicosComCarrinho();
            $carrinhoDeservicos->syncWithoutDetaching($servico->id);
            $carrinhoDeservicos->where('id', $id)->increment('quantidade');
        }
        return true;
    }


    public function buscarMeusServicos(): array | null
    {
        $usuario = Auth::user();
        if (!$usuario) {
            return null;
        }

        $servico = $usuario->servicosComCarrinho;

        $total = $servico->sum(function ($servicos) {
            return $servicos->valor * $servicos->pivot->quantidade;
        });

        return ['servico' => collect($servico), 'totalservicos' => $total];
    }



    public function removerDoCarrinho(string $id): void
    {
        $usuario = auth()->user();
        $usuario->servicosComCarrinho()->detach($id);
    }



    public function decrementarServico(string $id): null | bool
    {
        $usuario = auth()->user();

        if (!$servico = $this->model->findOrFail($id)) {
            return null;
        }

            $carrinhoDeservicos = $usuario->servicosComCarrinho();
            $carrinhoDeservicos->syncWithoutDetaching($servico->id);
            $carrinhoDeservicos->where('id', $id)->decrement('quantidade');
            $servicosSemQuantidade = auth()->user()->servicosComCarrinho()->where('quantidade', '<', 1)->get()->toArray();

            foreach($servicosSemQuantidade as $servicoNull) {
             $usuario->servicosComCarrinho()->detach($servicoNull['id']);
             }
           
        return true;
    }
}
