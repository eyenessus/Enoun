<?php

namespace App\Http\Controllers;

use App\DTO\Produto\createProdutoDto;
use App\DTO\Produto\UpdateProdutoDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProdutoEnounService;
use App\Http\Requests\UpdateProdutoRequest;
use App\Services\Produto\ProdutoEnounService;
use Illuminate\Support\Facades\Request;



class ProdutoEnounController extends Controller
{
  public function __construct(protected ProdutoEnounService $service){}
  
    public function index()
    {
        $categoria = $this->service->buscarCategorias();
        $produto = $this->service->getAll();
        return view('Produtos.produtos', ['produto' => $produto,'categoria' => $categoria]);
    }

    public function create()
    {
        $categorias = $this->service->buscarCategorias();
        return view('Cadastro.produto',['categorias' => $categorias]);
    }

    public function store(CreateProdutoEnounService $request)
    {
        $this->service->criarProduto(createProdutoDto::makeFromRequest($request));
        return redirect()->route('inicio');
    }

    public function show(string $id)
    {
        $produto = $this->service->findOne($id);
        return view('Produtos.exibicaoProduto',compact('produto'));
    }


    public function edit(string $id)
    {
        $produto = $this->service->findOne($id);
        $categoria = $this->service->buscarCategorias();
        return view('Produtos.edicaoProduto',compact('produto','categoria'));
    }


    public function update(UpdateProdutoRequest $request)
    {
        $produto =  $this->service->update(UpdateProdutoDTO::makeFromRequest($request));
        if(!$produto)
        {
            return back();
        }
        return redirect()->route('dashboard');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('dashboard');
    }

    public function adicionarPtCarrinho(string $id)
    {
        $this->service->adicionarAoCarrinho($id);
        return redirect()->route('carrinho');
    }


    public function removerDoCarrinho(string $id){
        $this->service->removerDoCarrinho($id);
        return redirect()->back();
    }

    public function decrementarDoCarrinho(string $id){
        $this->service->decrementarDoCarrinho($id);
        return redirect()->back();
    }
}
