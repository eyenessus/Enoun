@extends('layouts.main')
@section('title','Cadastro')
@section('conteudo')

<div class="container">
<h1>CADASTRO</h1>
<form class="row g-3" action="{{route('inserir')}}" method="POST">
@csrf
<div class="col-md-6">
    <label for="pnome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" required>
  </div>
  <div class="col-md-6">
    <label for="snome" class="form-label">Sobrenome</label>
    <input type="text" class="form-control" id="nome" name="sobrenome" required>
  </div>
  <div class="col-md-6">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="col-md-6">
    <label for="senha" class="form-label">Senha</label>
    <input type="password" class="form-control" id="senha" name="senha" required>
  </div>
  <div class="col-md-5">
    <label for="user" class="form-label">Usuário</label>
    <input type="text" class="form-control" id="user" name="user" required>
  </div>
  <div class="col-12">
    <label for="endereco" class="form-label">Endereço</label>
    <input type="text" class="form-control" id="endereco" placeholder="Rua Abilio Cesar 223" name="endereco" required>
  </div>

  <div class="col-md-6">
    <label for="cidade" class="form-label">Cidade</label>
    <input type="text" class="form-control" id="cidade" name="cidade" required>
  </div>
  <div class="col-md-4">
    <label for="estado" class="form-label">Estado</label>
    <select name="estado" class="form-select" required>
      <option selected>Escolha...</option>
      <option value="sp">SP</option>
    </select>
  </div>
  <div class="col-md-2"> 
    <label for="cep" class="form-label">CEP</label>
    <input type="text" class="form-control" id="cep" name="cep" required>
  </div>
 
  <div class="col-12">
  <button class="btn btn-info" type="submit" >Cadastrar</button>
  </div>
</form>






</div>


@endsection