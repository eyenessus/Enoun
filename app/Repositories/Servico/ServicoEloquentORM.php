<?php

namespace App\Repositories\Servico;

use App\DTO\Servico\CreateServicoDTO;
use App\DTO\Servico\UpdateServicoDTO;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Servico;
use App\Repositories\Servico\ServicoEnounInterface;
use Illuminate\Http\Request;
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


    public function findOne(string $id): Collection | null
    {
        if (!$servicoEncontrado = $this->model->findOrFail($id)) {
            return null;
        }
        return collect($servicoEncontrado);
    }


    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }


    public function createServico(CreateServicoDTO $dto): stdClass | array
    {
        $dto->user_id = Auth::user()->id;
        $dto->imagem = Storage::putFile('servicos', $dto->imagem);
        $servico = $this->model->create((array) $dto);

        return (object) $servico->toArray();
    }

    public function atualizarservico(UpdateServicoDTO $dto): null | stdClass
    {
        if (!$servico = $this->model->findOrFail($dto->id)) {
            return null;
        }
        Storage::delete($servico->imagem);
        $dto->imagem = Storage::putFile('servicos', $dto->imagem);
        $servico->update(['imagem' => $dto->imagem]);
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
            $carrinhoDeservicos = $usuario->servicosCarrinho();
            $carrinhoDeservicos->syncWithoutDetaching($servico->id);
            $carrinhoDeservicos->where('carrinho_id',$servico->id)->increment('quantidade');
        }
        return true;
    }


    public function buscarMeusServicos(): array | null
    {
        $usuario = auth()->user();
        if (!$usuario) {
            return null;
        }
        $servico = $usuario->servicosCarrinho;

        $total = $servico->sum(function ($servicos) {
            return $servicos->valor * $servicos->pivot->quantidade;
        });

        return ['servico' => collect($servico), 'totalservicos' => $total];
    }

    public function removerDoCarrinho(string $id): void
    {
        $usuario = auth()->user();
        $usuario->servicosCarrinho()->detach($id);
    }

    public function decrementarServico(string $id): null | bool
    {
        $usuario = auth()->user();
        if (!$servico = $this->model->findOrFail($id)) {
            return null;
        }
        $carrinhoDeservicos = $usuario->servicosCarrinho();
        $carrinhoDeservicos->syncWithoutDetaching($servico->id);
        $carrinhoDeservicos->where('carrinho_id',$servico->id)->decrement('quantidade');
       $itemVazio =  $carrinhoDeservicos->where('quantidade', '<', 1)->first();
       if($itemVazio)
       {
        $carrinhoDeservicos->detach($itemVazio->id);  
       }
         
        return true;
    }
}
