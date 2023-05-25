<?php

namespace App\Repositories\User;

use App\DTO\User\CreateUserDTO;
use App\DTO\User\UpdateUserDTO;
use App\Models\Categoria;
use App\Models\Endereco;
use App\Models\Identidade;
use App\Models\Pedido;
use App\Models\User;
use App\Repositories\User\UserEnounInterface;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        if (!$usuario = $this->model->findOrFail($id)) {
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
        Auth::login($usuario);
        return (object) $usuario->toArray();
    }

    public function updateUser(UpdateUserDTO $dto): stdClass | null
    {
        if (!$usuario = $this->model->findOrFail($dto->id)) {
            return null;
        }
        $imagem = Storage::putFile('user', $dto->imagemPerfil, 'public');
        $usuario['imagemPerfil'] = $imagem;
        $usuario->update((array)$dto);
        return (object)$usuario->toArray();
    }

    public function meusRegistros(): array
    {
        $user = Auth::user();
        $produtos = $user->produtos()->paginate(
            $perPage = 5, $columns = ['*'], $pageName = 'produtos'
        );
        $servicos = $user->servicos()->paginate(
            $perPage = 5, $columns = ['*'], $pageName = 'servicos'
        );
        return [
            'produtos' => $produtos,
            'servicos' => $servicos
        ];
    }

    public function  finalizarPedido(string $status = null, int $id = null): Collection
    {

        $user = auth()->user();
        $nome = [];
        $quantidadeUnitaria = [];
        $valorUnitario = [];
        $descricao = [];
        $produtos = $user->produtosCarrinho;
        $servicos = $user->servicosCarrinho;

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
        switch ($status) {
            case 'approved':
                $status = 'Aprovado';
                break;
            case 'canceled':
                $status = 'Cancelado';
                break;
            case 'rejected':
                $status = 'Rejeitado';
                break;
            case 'pending':
                $status = 'Pendente';
                break;
            default:
                $status = 'Processando...';
        }

        $pedido = Pedido::create(
            [
                'id' => $id ? $id : null,
                'nome' => $nome,
                'descricao' => $descricao,
                'status' => $status ? $status : 'Processando...',
                'quantidadeUnitaria' => $quantidadeUnitaria,
                'valorUnitario' => $valorUnitario,
                'user_id' => $user->id,
                'valorTotal' => $valorServicos + $valorProdutos
            ]
        );
        $user->produtosCarrinho()->detach();
        $user->servicosCarrinho()->detach();
        return collect($pedido);
    }

    public function verPedidos()
    {
        $usuarioLogado = auth()->user();
        $listaDePedidos = $usuarioLogado->pedidos()->orderBy('id', 'desc')->paginate(5);
        return  $listaDePedidos;
    }

    public function valorFinal(): array
    {
        $user = auth()->user();
        $produtos = $user->produtosCarrinho;
        $servicos = $user->servicosCarrinho;

        $valorServicos = $servicos->sum(function ($servico) {
            return $servico->valor * $servico['pivot']['quantidade'];
        });
        $valorProdutos = $produtos->sum(function ($produto) {
            return $produto->valor * $produto['pivot']['quantidade'];
        });

        return ["total" => $valorProdutos + $valorServicos];
    }

    public function salvarCategoria(Request $request)
    {
        Categoria::create(['nome' => $request->categoria]);
    }

    public function  criarIdentidade(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        Identidade::create($request->all());
        return true;
    }


    public function criarEndereco(Request $request)
    {

        $request['user_id'] = auth()->user()->id;
        Endereco::create($request->all());
        return true;
    }

    public function buscarItensCarrinho(): array
    {
        $produtos = auth()->user()->produtosCarrinho;
        $servicos = auth()->user()->servicosCarrinho;
        return [
            'produto' => collect($produtos),
            'servicos' => collect($servicos)
        ];
    }

    public function buscarCupons()
    {
        $user = auth()->user()->cupons()->first();
        return $user;
    }
}
