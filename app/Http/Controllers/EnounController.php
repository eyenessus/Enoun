<?php

namespace App\Http\Controllers;
use App\DTO\CreateUserDTO;
use App\DTO\UpdateUserDTO;
use App\Http\Controllers\Controller;
use App\Services\EnounService;
use Illuminate\Http\Request;

class EnounController extends Controller
{
  
   public function __construct(protected EnounService $service)
   {}

    public function index()
    {
        return view('welcome');
    }

 
    public function create(Request $request)
    {
    
        $this->service->create(CreateUserDTO::makeFromRequest($request));
        return redirect()->route('inicio');
    }


    public function store(Request $request)
    {
        
    }

    public function show(string $id)
    {
        if(!$usuario = $this->service->findOne($id)){
            return back();
        }
    }

    public function edit(string $id)
    {
        if(!$usuario = $this->service->findOne($id)){
            return back();
        }
    }


    public function update(Request $request, string $id)
    {
        $usuario = $this->service->update(UpdateUserDTO::makeFromRequest($request));
        if(!$usuario){
            return back();
        }
    }


    public function destroy(string $id)
    {

     $this->service->delete($id);

     return redirect()->route('welcome');
     
    }

    public function login(){

     return view('Login.login');
    }
    public function cadastro(){
        return view('Cadastro.cadastro');
    }

    public function servicos(){
        return view('Servicos.servicos');
    }

    public function produtos(){
        return view('Produtos.produtos');
    }

    public function sobre(){
        return view('Sobre.sobre');
    }
    
    public function recuperar(){
        return view('Login.recuperar');
    }
    public function dashboard(){
        return view('Dashboard.dashboard');
    }
    public function carrinho(){
        return view('Carrinho.carrinho');
    }
}
