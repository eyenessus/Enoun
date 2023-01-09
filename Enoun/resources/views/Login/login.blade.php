@extends('layouts.main')
@section('titulo','Login')
@section('conteudo')

<div class="container">
<h1 class="p-2 p-md-3">Login</h1>
<div class="m-md-5">
  <form class="row g-3 shadow-lg p-3 mb-5 bg-body-tertiary rounded-3 m-3 mt-md-1 m-md-5 bg-light ">
    <div class="mb-3">
      <label for="user" class="form-label">Usuário</label>
      <input type="text" class="form-control" id="user" required>
  
    </div>
    <div class="mb-3">
      <label for="senha" class="form-label">Senha</label>
      <input type="password" class="form-control" id="senha" required>
      <div id="senha" class="form-text">Nunca compartilhe sua senhas.</div>
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Entrar</button> 
    </div>
    
 
  </form>
</div>

</div>
@endsection