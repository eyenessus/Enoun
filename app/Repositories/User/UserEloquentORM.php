<?php
namespace App\Repositories\User;

use App\DTO\User\CreateUserDTO;
use App\Models\Produto;
use App\Models\Servico;
use App\Models\User;
use App\Repositories\User\UserEnounInterface;
use Illuminate\Support\Facades\Auth;
use stdClass;

class UserEloquentORM implements UserEnounInterface
{
    public function __construct(protected User $model)
    {}

    public function getAllUser(): array
    {
      return $this->model->all()->toArray();
    }

    public function findOneUser(string $id): stdClass | null
    {
        if(!$usuario = $this->model->findOne($id)){
            return null;
        }
        return (object) $usuario->toArray();;
    }


    public function deleteUser(string $id) : void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function createUser(CreateUserDTO $dto) : stdClass | null   
    {
            $usuario = $this->model->create(
                (array)$dto
            );
        return (object) $usuario->toArray();
    }

    public function updateUser(string $id): stdClass | null
    {
        if(!$usuario = $this->model->findOrFail($id)){
            return null;
        }
        return (object)$usuario->toArray();
    }

    public function meusRegistros() : array
    {
        $user= Auth::user();
        $produtos = $user->produtos()->paginate(1);
        
        $servicos = $user->servicos()->paginate(1);
        
        return [
            'produtos' => $produtos,
            'servicos' => $servicos];
    }
}