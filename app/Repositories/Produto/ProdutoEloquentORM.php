<?php

namespace App\Repositories\Produto;



use App\DTO\Produto\createProdutoDto;
use App\DTO\Produto\UpdateProdutoDTO;
use App\Models\Categoria;
use App\Models\Produto;
use App\Repositories\Produto\ProdutoEnounInterface;
use Carbon\Carbon;
use Illuminate\Cache\CacheManager;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Predis\Client;
use stdClass;



class ProdutoEloquentORM implements ProdutoEnounInterface
{

    public function __construct(
        protected Produto $model,
        protected Client $redis,
        protected CacheManager $cache,
        protected Carbon $carbon
    ) {
    }

    public function getAll(): Collection
    {
        //Cache::flush();
        //Cache::putMany(['oi'=>'3','i'=>4]);

        $tempo = $this->carbon->addHours(2);
        $resultado = $this->cache->remember('produtos', $tempo, function () {
            return $this->model->all();
        });

        return collect($resultado);
    }

    public function findOne(string $id): Collection | null
    {
        $tempo = $this->carbon->addHours(10);
        $produto = $this->cache->remember('viewProduto:' . $id, $tempo, function () use ($id) {
            if (!$produto = $this->model->findOrFail($id)) {
                return null;
            }
            return $produto;
        });
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



        //    $t = $this->redis->lindex('produto:'.$id,0);
        // $t =   $this->redis->llen('produto:'.$id);

        $tempo = 90 * 60; //tempo de cache do item dentro do carinho
        $usuario = auth()->user();
        if (!$produto = $this->model->findOrFail($id)) {
            return null;
        }

        $this->redis->rpush('produto:' . $id, $produto); //adiciona a lista em memoria cache
        $this->redis->expire('produto:' . $id, $tempo); //tempo de expirção aplicada

        if ($usuario) {
            $carrinhoDeProdutos = $usuario->produtosCarrinho();
            $carrinhoDeProdutos->syncWithoutDetaching($produto->id);
            $carrinhoDeProdutos->where('carrinho_id', $produto->id)->increment('quantidade');
        }

        return true;
    }
    public function buscarMeuProdutos(): array | null
    {
        $total = 0;
        $usuario = auth()->user();

        if ($usuario) {
            $produto = $usuario->produtosCarrinho;
            $total = $produto->sum(function ($produto) {
                return $produto->valor * $produto->pivot->quantidade;
            });
        } else {
            $respostaCache = $this->redis->pipeline(function ($pipe) {
                $count = $this->redis->keys('produto:*');
                foreach ($count as $key) {
                    $pipe->lindex($key, 0); // pegando primeiro item
                    $pipe->llen($key); // quantidade de itens
                }
            });

            $produto = [];
            $valorCont = [];
            $quantidade = [];

            foreach ($respostaCache as $index => $valor) {
                if ($index % 2 == 0) {
                    $produto[$index] = json_decode($valor);
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




        return ['produto' => collect($produto), 'totalProdutos' => $total, 'quantidade' => $usuario ? 0 : $quantidade];
    }


    public function removerDoCarrinho(string $id): void
    {
        $usuario = auth()->user();
        $this->redis->del('produto:' . $id);
        if ($usuario) {
            $usuario->produtosCarrinho()->detach($id);
        }
    }

    public function decrementarProduto(string $id): null | bool
    {
        $this->redis->rpop('produto:' . $id);
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
