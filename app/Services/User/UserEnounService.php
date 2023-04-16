<?php
namespace App\Services\User;

use App\DTO\User\CreateUserDTO;
use App\Http\Requests\LoginUserRequest;
use App\Repositories\Produto\ProdutoEnounInterface;
use App\Repositories\User\UserEnounInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use stdClass;

class UserEnounService {
    

    public function __construct(
    protected UserEnounInterface $repositoryUser, 
    protected ProdutoEnounInterface $repositoryProdutos) {}

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

    public function autenticarUser(LoginUserRequest $request) : RedirectResponse
    { 
        $credenciais = $request->only('email','password');
        if (Auth::attempt($credenciais)) 
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        
        return redirect()->route('login')->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
           
    }

    public function sair(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function meusRegistros() : array
    {
       return $this->repositoryUser->meusRegistros();
    }
   
    public function finalizarPedido() : Collection
    {
        return  $this->repositoryUser->finalizarPedido();
    }
}