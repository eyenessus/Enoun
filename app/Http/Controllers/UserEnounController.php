<?php

namespace App\Http\Controllers;

use App\DTO\User\CreateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Pay\MercadoPagoController;
use App\Http\Requests\CreateUserEnounRequest;
use App\Http\Requests\LoginUserRequest;
use App\Services\Produto\ProdutoEnounService;
use App\Services\Servico\ServicoEnounService;
use App\Services\User\UserEnounService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class UserEnounController extends Controller
{
    
    public function __construct(
        protected UserEnounService $service,
        protected ProdutoEnounService $serviceProduto,
        protected ServicoEnounService $serviceServicos,
        protected MercadoPagoController $mercadoPago
    ) {
        $this->mercadoPago = $mercadoPago;
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
        return redirect()->route('identidade');
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
        $produto =  $this->serviceProduto->buscarMeuProdutos();
        $servico = $this->serviceServicos->buscarMeusServicos();
        return view('Carrinho.carrinho', [
            'servico' => $servico['servico'],
            'totalServicos' => $servico['totalservicos'],
            'produto' => $produto['produto'],
            'totalProdutos' => $produto['totalProdutos']
        ]);
    }

    public function meusPedidos()
    {
        $pedidos = $this->service->verPedidos();
        return view('Pedidos.pedidos', compact('pedidos'));
    }

    public function formCategoria()
    {
        return view('Cadastro.categoria');
    }

    public function salvarCategoria(Request $request)
    {
        $this->service->salvarCategoria($request);
        return redirect()->route('categoria.index');
    }

    public function todasCategoria()
    {
        return view('Gerenciamento.Categoria.categorias');
    }

    public function verTodosUsuarios()
    {
        return view('Gerenciamento.User.users');
    }
    public function verTodosProdutos()
    {
        return view('Gerenciamento.Produto.produtos');
    }
    public function verTodosServicos()
    {
        return view('Gerenciamento.Servico.servicos');
    }
    public function verTodosAdmins()
    {
        return view('Gerenciamento.Admin.admins');
    }



    public function formcadastrarIdentidade()
    {
        return view('Cadastro.identidade');
    }

    public function formEndereco()
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

    public function endereco(Request $request)
    {
        $this->service->criarEndereco($request);
        $this->mercadoPago->criarCliente();
        return redirect()->route('inicio');
    }
}
