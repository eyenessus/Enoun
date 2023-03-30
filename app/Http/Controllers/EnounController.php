<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class EnounController extends Controller
{
    
    public function index()
    {
        return view('welcome');
    }

 
    public function create()
    {
        
    }


    public function store(Request $request)
    {
        User::create($request->all());
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
