<?php

namespace App\Repositories\User;

use App\DTO\User\CreateUserDTO;
use App\Models\Pedido;
use App\Models\User;
use App\Repositories\User\UserEnounInterface;
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

    public function  finalizarPedido(): bool
    {

        $user = Auth::user();
        $produtos = $user->produtosComCarrinho;
        $servicos = $user->servicosComCarrinho;

        $valorServicos = $servicos->sum(function ($servico) {
            return $servico->valor * $servico['pivot']['quantidade'];
        });

        $valorProdutos = $produtos->sum(function ($produto) {
            return $produto->valor * $produto['pivot']['quantidade'];
        });

        $nome = [];
        $quantidadeUnitaria= [];
        $valorUnitario =[];

        foreach($produtos as $produto)
        {
            array_push($nome,$produto['nome']);
            array_push($quantidadeUnitaria,$produto['pivot']['quantidade']);
            array_push($valorUnitario, $produto['valor']);
        }
    
        
        foreach ($servicos as $servico)
        {
            array_push($nome,$servico['nome']);
            array_push($quantidadeUnitaria,$servico['pivot']['quantidade']);
            array_push($valorUnitario, $servico['valor']);
        }
       
        Pedido::create(
            [
                'descricao' => $nome,
                'status' => 'Processando...',
                'quantidadeUnitaria' => $quantidadeUnitaria,
                'valorUnitario' => $valorUnitario,
                'user_id' => $user->id,
                'valorTotal' => $valorServicos + $valorProdutos
            ]
        );

        return true;
    }
}
