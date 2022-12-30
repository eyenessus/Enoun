@extends('layouts.main')
@section('title','Login')
@section('conteudo')

<div class="container">
<h1>Login</h1>
<form>
  <div class="mb-3">
    <label for="user" class="form-label">Usuário</label>
    <input type="text" class="form-control" id="user" >

  </div>
  <div class="mb-3">
    <label for="senha" class="form-label">Senha</label>
    <input type="password" class="form-control" id="senha">
    <div id="senha" class="form-text">Nunca compartilhe sua senhas.</div>
  </div>
  
  <button type="submit" class="btn btn-primary">Entrar</button>
</form>
</div>
@endsection