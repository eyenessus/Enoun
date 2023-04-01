<?php
namespace App\Repositories;

use App\DTO\User\CreateUserDTO;
use App\Models\User;
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
}