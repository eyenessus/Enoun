<?php

namespace App\Http\Controllers;

use App\DTO\Produto\createProdutoDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProdutoEnounService;

use App\Models\Categoria;
use App\Models\Produto;
use App\Services\Produto\ProdutoEnounService;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

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
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);
        return view('welcome');
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
