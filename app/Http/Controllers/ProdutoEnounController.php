<?php

namespace App\Http\Controllers;

use App\DTO\User\createProdutoDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProdutoEnounService;

use App\Models\Produto;
use App\Services\Produto\ProdutoEnounService;
use Illuminate\Http\Request;

class ProdutoEnounController extends Controller
{
  public function __construct(protected ProdutoEnounService $service){}
    public function index()
    {
        $produto = $this->service->getAll();
    
        return view('Produtos.produtos', ['produto' => $produto]);
    }


    public function create()
    {
      
        $categorias = $this->service->buscarCategorias();
        return view('Cadastro.produto',['categorias' => $categorias]);
    }


    public function store(CreateProdutoEnounService $request)
    {
        $this->service->criarProduto(createProdutoDto::makeFromRequest($request));
        return view('welcome');
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
        //
    }

    

}
