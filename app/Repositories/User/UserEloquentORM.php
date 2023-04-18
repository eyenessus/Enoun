<?php

namespace App\Repositories\User;

use App\DTO\User\CreateUserDTO;
use App\Models\Pedido;
use App\Models\User;
use App\Repositories\User\UserEnounInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use stdClass;

class UserEloquentORM implements UserEnounInterface
{
    public function __construct(protected User $model)
    {
    }

    public function getAllUser(): array
    {
        return $this->model->all()->toArray();
    }

    public function findOneUser(string $id): stdClass | null
    {
        if (!$usuario = $this->model->findOne($id)) {
            return null;
        }
        return (object) $usuario->toArray();;
    }


    public function deleteUser(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function createUser(CreateUserDTO $dto): stdClass | null
    {
        $usuario = $this->model->create(
            (array)$dto
        );
        return (object) $usuario->toArray();
    }

    public function updateUser(string $id): stdClass | null
    {
        if (!$usuario = $this->model->findOrFail($id)) {
            return null;
        }
        return (object)$usuario->toArray();
    }

    public function meusRegistros(): array
    {
        $user = Auth::user();
        $produtos = $user->produtos()->paginate();
        $servicos = $user->servicos()->paginate();
        return [
            'produtos' => $produtos,
            'servicos' => $servicos
        ];
    }

    public function  finalizarPedido(): Collection
    {
        $user = Auth::user();
        $nome = [];
        $quantidadeUnitaria = [];
        $valorUnitario = [];
        $descricao = [];
        $produtos = $user->produtosComCarrinho;
        $servicos = $user->servicosComCarrinho;

        $valorServicos = $servicos->sum(function ($servico) {
            return $servico->valor * $servico['pivot']['quantidade'];
        });
        $valorProdutos = $produtos->sum(function ($produto) {
            return $produto->valor * $produto['pivot']['quantidade'];
        });

        foreach (array_merge($produtos->toArray(), $servicos->toArray()) as $item) {
            $nome[] = $item['nome'];
            $quantidadeUnitaria[] = $item['pivot']['quantidade'];
            $valorUnitario[] = $item['valor'];
            $descricao[] = $item['descricao'];
        }
        $pedido = Pedido::create(
            [
                'nome' => $nome,
                'descricao' => $descricao,
                'status' => 'Processando...',
                'quantidadeUnitaria' => $quantidadeUnitaria,
                'valorUnitario' => $valorUnitario,
                'user_id' => $user->id,
                'valorTotal' => $valorServicos + $valorProdutos
            ]
        );
        $user->produtosComCarrinho()->detach();
        $user->servicosComCarrinho()->detach();
        return collect($pedido);
    }

    public function verPedidos()
    {
        $usuarioLogado = auth()->user();
        $listaDePedidos = $usuarioLogado->pedidos()->orderBy('id', 'desc')->simplePaginate(4);
        return  $listaDePedidos;
    }
}
