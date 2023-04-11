<?php
namespace App\Repositories;
use App\DTO\User\CreateUserDTO;
use Illuminate\Support\Collection;
use stdClass;
interface UserEnounInterface{
    public function getAllUser(): array;

    public function findOneUser(string $id) : stdClass | null;
  
    public function deleteUser(string $id) : void;

    public function createUser(CreateUserDTO $dto): stdClass | null;

    public function updateUser(string $id): stdClass | null;

  
}