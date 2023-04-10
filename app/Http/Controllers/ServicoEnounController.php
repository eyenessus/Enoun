<?php

namespace App\Http\Controllers;

use App\DTO\Servico\CreateServicoDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServicoEnounRequest;
use App\Models\Categoria;
use App\Models\Servico;
use App\Services\Servico\ServicoEnounService;
use Illuminate\Http\Request;

class ServicoEnounController extends Controller
{
    public function __construct(protected ServicoEnounService $service)
    {}

    public function index()
    {
        $servico = $this->service->getAll();

        return view('Servicos.servicos',compact('servico'));
    }


    public function create()
    {
        $categorias = Categoria::all();
        return view('Cadastro.servico', compact('categorias'));
  
    }

    public function store(CreateServicoEnounRequest $request)
    {
        $this->service->createServico(CreateServicoDTO::makeRequest($request));
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
        //
    }
}
