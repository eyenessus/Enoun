<?php
namespace App\Services\User;

use App\DTO\User\CreateUserDTO;
use App\Http\Requests\CreateUserEnounRequest;
use App\Http\Requests\LoginUserRequest;
use App\Repositories\ProdutoEnounInterface;
use App\Repositories\UserEnounInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserEnounService {
    

    public function __construct(protected UserEnounInterface $repositoryUser, protected ProdutoEnounInterface $repositoryProdutos) {}

    public function getAllUser(): array 
    {   
        return $this->repositoryUser->getAllUser();
    }

    public function findOneUser(string $id) : stdClass | null
    {
        return $this->repositoryUser->findOneUser($id);
    }

    public function deleteUser(string $id) : void
    {
        $this->repositoryUser->deleteUser($id);
    }

    public function createUser(CreateUserDTO $dto): stdClass | null
    {
        
        return  $this->repositoryUser->createUser($dto);
    }

    public function updateUser(string $id): stdClass | null
    {
        return $this->repositoryUser->updateUser($id);
    }

    public function autenticarUser(LoginUserRequest $request) : bool
    {
        
        $credenciais = $request->only('email','password');

        if (Auth::attempt($credenciais)) 
        {
            $request->session()->regenerate();
 
            return true;
        }
        
            return false;

    }

   
}