<?php

namespace App\Http\Controllers;

use App\DTO\User\CreateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserEnounRequest;
use App\Services\User\UserEnounService;
use Illuminate\Http\Request;

class UserEnounController extends Controller
{
    public function __construct(protected UserEnounService $service)
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
