<?php

namespace App\Repositories\Servico;

use App\DTO\Servico\CreateServicoDTO;
use App\DTO\Servico\UpdateServicoDTO;
use App\Models\Categoria;
use App\Models\Servico;
use App\Repositories\Servico\ServicoEnounInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Predis\Client;
use stdClass;

class ServicoEloquentORM implements ServicoEnounInterface
{

    public function __construct(
        protected Servico $model,
        protected Client $redis,
    ) {
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
        $tempo = 90 * 60; //tempo de cache do item dentro do carinho

        if (!$produto = $this->model->findOrFail($id)) {
            return null;
        }

        $this->redis->rpush('servico:' . $id, $produto); //adiciona a lista em memoria cache
        $this->redis->expire('servico:' . $id, $tempo); //tempo de expirção aplicada

        if ($usuario) {
            $carrinhoDeservicos = $usuario->servicosCarrinho();
            $carrinhoDeservicos->syncWithoutDetaching($servico->id);
            $carrinhoDeservicos->where('carrinho_id', $servico->id)->increment('quantidade');
        }
        return true;
    }


    public function buscarMeusServicos(): array | null
    {


        $total = 0;
        $usuario = auth()->user();

        if ($usuario) {
            $servico = $usuario->servicosCarrinho;
            $total = $servico->sum(function ($servico) {
                return $servico->valor * $servico->pivot->quantidade;
            });
        } else {
            $respostaCache = $this->redis->pipeline(function ($pipe) {
                $count = $this->redis->keys('servico:*');
                foreach ($count as $key) {
                    $pipe->lindex($key, 0); // pegando primeiro item
                    $pipe->llen($key); // quantidade de itens
                }
            });

            $servico = [];
            $valorCont = [];
            $quantidade = [];

            foreach ($respostaCache as $index => $valor) {
                if ($index % 2 == 0) {
                    $servico[$index] = json_decode($valor);
                    $valorUnit = json_decode($respostaCache[$index], true);
                    $valorCont[] = (float) $valorUnit['valor'];
                } else {
                    $quantidade[$index] = $respostaCache[$index];
                }
            }

            $total = array_sum(array_map(function ($quant, $valor) {
                return $quant * $valor;
            }, $quantidade, $valorCont));
        }

        return ['servico' => collect($servico), 'totalservicos' => $total, 'quantidade' => $usuario ? 0 : $quantidade];
    }

    public function removerDoCarrinho(string $id): void
    {
        $usuario = auth()->user();
        $this->redis->del('servico:' . $id);
        if ($usuario) {
            $usuario->servicosCarrinho()->detach($id);
        }
    }

    public function decrementarServico(string $id): null | bool
    {
        $usuario = auth()->user();
        if (!$servico = $this->model->findOrFail($id)) {
            return null;
        }
        $carrinhoDeservicos = $usuario->servicosCarrinho();
        $carrinhoDeservicos->syncWithoutDetaching($servico->id);
        $carrinhoDeservicos->where('carrinho_id', $servico->id)->decrement('quantidade');
        $itemVazio =  $carrinhoDeservicos->where('quantidade', '<', 1)->first();
        if ($itemVazio) {
            $carrinhoDeservicos->detach($itemVazio->id);
        }

        return true;
    }
}
