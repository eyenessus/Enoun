<?php

namespace App\Http\Controllers;

use App\DTO\User\CreateUserDTO;
use App\DTO\User\UpdateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Pay\MercadoPagoController;
use App\Http\Requests\CreateUserEnounRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\Carrinho;
use App\Models\Cupom;
use App\Services\Produto\ProdutoEnounService;
use App\Services\Servico\ServicoEnounService;
use App\Services\User\UserEnounService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Predis\Client;


class UserEnounController extends Controller
{

    public function __construct(
        protected UserEnounService $service,
        protected ProdutoEnounService $serviceProduto,
        protected ServicoEnounService $serviceServicos,
        protected MercadoPagoController $mercadoPago,
        protected Client $redis,
    ) {
    }

    public function index(): View
    {
        return view('Login.login');
    }

    public function create(): View
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
        $usuario = $this->service->findOneUser($id);
        if ($usuario->id == (int)Auth::id()) {
            return view('User.formPerfil', compact('usuario'));
        }
        return redirect()->route('inicio');
    }


    public function update(Request $request)
    {
        $usuario = $this->service->updateUser(UpdateUserDTO::makeRequest($request));
        return redirect()->route('meuPerfil');
    }


    public function destroy(string $id)
    {
        $this->service->deleteUser($id);
        return redirect()->route('inicio');
    }


    public function recuperar(): View
    {
        return view('Login.recuperar');
    }

    public function autenticar(LoginUserRequest $request): RedirectResponse
    {
        return $this->service->autenticarUser($request);
    }

    public function sair(Request $request): RedirectResponse
    {
        return $this->service->sair($request);
    }


    public function dashboard(): View
    {
        $prodServices = $this->service->meusRegistros();
        return view('Dashboard.dashboard', ['registros' => $prodServices]);
    }


    public function carrinho(): View
    {
        $cupom = $this->service->buscarCupons();
        $produto =  $this->serviceProduto->buscarMeuProdutos();
        $servico = $this->serviceServicos->buscarMeusServicos();
        
        return view('Carrinho.carrinho', [
            'servico' => $servico['servico'],
            'totalServicos' => $servico['totalservicos'],
            'produto' => $produto['produto'],
            'totalProdutos' => $produto['totalProdutos'],
            'quantidadeP'=> $produto['quantidade'],
            'quantidadeS'=>$servico['quantidade']
        ]);
    }

    public function meusPedidos(): View
    {
        $pedidos = $this->service->verPedidos();
        return view('Pedidos.pedidos', compact('pedidos'));
    }

    public function formCategoria(): View
    {
        return view('Cadastro.categoria');
    }

    public function salvarCategoria(Request $request)
    {
        $this->service->salvarCategoria($request);
        return redirect()->route('categoria.index');
    }

    public function todasCategoria(): View
    {
        $categorias = $this->serviceProduto->buscarCategorias();
        return view('Gerenciamento.Categoria.categorias', compact('categorias'));
    }

    public function verTodosUsuarios(): View
    {
        $users = $this->service->getAllUser();
        return view('Gerenciamento.User.users', compact('users'));
    }


    public function verTodosAdmins(): View
    {
        return view('Gerenciamento.Admin.admins');
    }


    public function formcadastrarIdentidade(): View
    {
        return view('Cadastro.identidade');
    }

    public function formEndereco(): View
    {
        return view('Cadastro.endereco');
    }

    public function identidade(Request $request)
    {
        $status =  $this->service->criarIdentidade($request);
        if ($status) {
            return redirect()->route('endereco');
        }
    }

    public function endereco(Request $request): RedirectResponse
    {
        $this->service->criarEndereco($request);
        $this->mercadoPago->criarCliente();
        return redirect()->route('inicio');
    }

    public function meuPerfil(): View
    {
        $meuPerfil =  $this->service->meuPerfil();
        return view('User.configuracoes', compact('meuPerfil'));
    }

    public function meusPlanos(): View
    {
        return view('User.plano');
    }

    public function cupom(Request $request)
    {

        $user = auth()->user();
        $cupom = Cupom::where('codigoResgate', $request->cupom)->first();
        $user->cupons()->sync($cupom->id);
        return response(true);
    }
}
