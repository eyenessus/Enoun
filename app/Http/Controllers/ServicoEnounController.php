<?php

namespace App\Http\Controllers;

use App\DTO\Servico\CreateServicoDTO;
use App\DTO\Servico\UpdateServicoDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServicoEnounRequest;
use App\Http\Requests\Servico\UpdateServicoRequest;
use App\Models\Categoria;
use App\Models\Servico;
use App\Services\Servico\ServicoEnounService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServicoEnounController extends Controller
{
    public function __construct(protected ServicoEnounService $service)
    {
    }

    public function index(): View
    {
        $servico = $this->service->getAll();
        $categoria = $this->service->buscarCategorias();
        return view('Servicos.servicos', compact('servico', 'categoria'));
    }


    public function create(): View
    {
        $categorias = Categoria::all();
        return view('Servicos.cadastrarServico', compact('categorias'));
    }

    public function store(CreateServicoEnounRequest $request): RedirectResponse
    {
        $this->service->createServico(CreateServicoDTO::makeRequest($request));
        return redirect()->route('inicio');
    }

    public function show(string $id): View
    {
        $servico = $this->service->findOne($id);
        return view('Servicos.exibicaoServico', compact('servico'));
    }

    public function edit(string $id): View
    {
        $servico =   $this->service->findOne($id);
        $categorias = $this->service->buscarCategorias();
        return view('Servicos.edicaoServico',compact('servico','categorias'));
    }


    public function update(UpdateServicoRequest $request): RedirectResponse
    {
        $servico =  $this->service->atualizarServico(UpdateServicoDTO::makeRequest($request));
        return redirect()->route('dashboard');
    }


    public function destroy(string $id): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    public function adicionarSvCarrinho(string $id): RedirectResponse
    {
        $this->service->adicionarAoCarrinho($id);
        return redirect()->route('carrinho.index');
    }


    public function removerDoCarrinho(string $id): RedirectResponse
    {
        $this->service->removerDoCarrinho($id);
        return redirect()->back();
    }

    public function decrementarDoCarrinho(string $id): RedirectResponse
    {
        $this->service->decrementarDoCarrinho($id);
        return redirect()->back();
    }
    public function verTodosServicos()
    {
       $servicos = $this->service->getAll();
        return view('Gerenciamento.Servico.servicos', compact('servicos'));
    }
}
