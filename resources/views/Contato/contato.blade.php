@extends('layouts.main')
@section('titulo','Contato')
@section('conteudo')
<div class="container">
 
<form action="{{route('contate')}}" method="POST" name="cadastro" class="row g-3 shadow-lg p-3 mb-5 bg-body-tertiary rounded-3 m-3 mt-md-3 m-md-5 bg-light">
@csrf
<h1 class=" p-md-3">Contato</h1>
<div class="mb-3">
  <label for="user" class="form-label">Usuário</label>
  <input type="text" class="form-control" id="user" placeholder="EXEMPLO22" name="usuario" required>
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Mensagem</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="mensagem" required></textarea>
</div>

<div>
  <button class="btn btn-primary float-end" type="submit" name="cadastro" value="Cadastro" >Enviar</button>
</div>



</form>

</div>
@endsection

