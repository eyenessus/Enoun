@extends('layouts.main')
@section('titulo','Cadastro')
@section('conteudo')

<div class="container">

<form class="row g-3 shadow-lg p-3 mb-5 bg-body-tertiary rounded-3 m-3 mt-md-3 bg-light" method="POST" action="{{ route('register') }}" >
@csrf
<h1 class="p-md-3">CADASTRO</h1>
  
<div class="col-md-6">
    <label for="pnome" class="form-label">Nome</label>
    <input  class="form-control" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
  </div>
 
  <div class="col-md-6">
    <label for="email" class="form-label">Email</label>
    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required>
  </div>
  <div class="col-md-6">
    <label for="password" class="form-label">Senha</label>
    <input type="password" class="form-control" id="senha" name="password" required>
  </div>

  <div class="mt-4">
    <label for="password_confirmation">Confirmação de senha</label>
    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
  </div>

<div class="col-md-5">
    <label for="user" class="form-label">Usuário</label>
    <input type="text" class="form-control" id="user" name="user" required>
  </div>
  <div class="col-md-7"> 
    <label for="cep" class="form-label">CEP</label>
    <input type="text" class="form-control" id="cep" name="cep" required>
  </div>
  <div class="col-12">
    <label for="endereco" class="form-label">Endereço</label>
    <input type="text" class="form-control" id="endereco" placeholder="Rua Abilio Cesar 223" name="endereco" required>
  </div>
  <div class="col-5">
    <label for="endereco" class="form-label">Número</label>
    <input type="number" class="form-control" id="numero" name="numero" required>
  </div>
  <div class="col-md-6">
    <label for="cidade" class="form-label">Cidade</label>
    <input type="text" class="form-control" id="cidade" name="cidade" required>
  </div>
  <div class="col-md-4">
    <label for="estado" class="form-label">Estado</label>
    <input type="text" class="form-control" id="estado" name="estado">
  </div>
 

  <div class="col-12">
  <button class="btn btn-info float-end" type="submit" >Cadastrar</button>
  </div>
</form>

</div>


@endsection