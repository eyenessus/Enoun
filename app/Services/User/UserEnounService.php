<?php
namespace App\Services\User;

use App\DTO\User\CreateUserDTO;
use App\Http\Requests\LoginUserRequest;
use App\Repositories\Produto\ProdutoEnounInterface;
use App\Repositories\User\UserEnounInterface;
use App\Services\Pay\MercadoPago\MercadoPagoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use stdClass;

class UserEnounService {
    

    public function __construct(
    protected UserEnounInterface $repositoryUser, 
    protected ProdutoEnounInterface $repositoryProdutos,
    ) {   
    }

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
       
        return $this->repositoryUser->createUser($dto);
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
   
    public function finalizarPedido(string $status = null, int $id=null) : Collection
    {
        return  $this->repositoryUser->finalizarPedido($status,$id);
    }

    public function verPedidos() 
    {
        return $this->repositoryUser->verPedidos();
    }
    public function valorFinal()
    {
        return $this->repositoryUser->valorFinal();
    }

    public function salvarCategoria(Request $request)
    {
        return $this->repositoryUser->salvarCategoria($request);
    }
    public function  criarIdentidade(Request $request)
    {
       return $this->repositoryUser->criarIdentidade($request);
    }

    public function criarEndereco(Request $request)
    {
        return $this->repositoryUser->criarEndereco($request);
    }

    public function buscarItensCarrinho(): array
    {
       return $this->repositoryUser->buscarItensCarrinho();
    }

    public function meuPerfil()
    {
     
        return Auth::user();
    }
}