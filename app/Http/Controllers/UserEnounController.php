<?php

namespace App\Http\Controllers;

use App\DTO\User\CreateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserEnounRequest;
use App\Http\Requests\LoginUserRequest;
use App\Services\Produto\ProdutoEnounService;
use App\Services\User\UserEnounService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEnounController extends Controller
{
    public function __construct(protected UserEnounService $service, protected ProdutoEnounService $serviceProduto)
    {
    }

    public function index()
    {
        return view('Login.login');
    }


    public function create()
    {
        return view('Cadastro.cadastro');
    }


    public function store(CreateUserEnounRequest $request)
    {

        $this->service->createUser(CreateUserDTO::makeFromRequest($request));

        return redirect()->route('inicio');
    }


    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }


    public function update(Request $request, string $id)
    {
    }


    public function destroy(string $id)
    {
    }


    public function recuperar()
    {
        return view('Login.recuperar');
    }

    public function autenticar(LoginUserRequest $request): RedirectResponse
    {
        $auth = $this->service->autenticarUser($request);

        if ($auth) {
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



    public function dashboard()
    {
        return view('Dashboard.dashboard');
    }



    public function carrinho()
    {
        $produto =  $this->serviceProduto->buscarMeuProdutos();
        
        return view('Carrinho.carrinho',compact('produto'));
    }
}
