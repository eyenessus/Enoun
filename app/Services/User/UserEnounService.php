<?php
namespace App\Services\User;

use App\DTO\User\CreateUserDTO;
use App\Http\Requests\CreateUserEnounRequest;
use App\Repositories\UserEnounInterface;
use stdClass;

class UserEnounService {
    

    public function __construct(protected UserEnounInterface $repository) {}

    public function getAllUser(): array 
    {   
        return $this->repository->getAllUser();
    }

    public function findOneUser(string $id) : stdClass | null
    {
        return $this->repository->findOneUser($id);
    }

    public function deleteUser(string $id) : void
    {
        $this->repository->deleteUser($id);
    }

    public function createUser(CreateUserDTO $dto): stdClass | null
    {
        
        return  $this->repository->createUser($dto);
    }

    public function updateUser(string $id): stdClass | null
    {
        return $this->repository->updateUser($id);
    }

}