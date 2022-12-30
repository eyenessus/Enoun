@extends('layouts.main')
@section('title','Contato')
@section('conteudo')
<div class="container">
<form action="" method="POST" name="cadastro">
<h1>Contato</h1>
<div class="mb-3">
  <label for="user" class="form-label">Usuário</label>
  <input type="text" class="form-control" id="user" placeholder="EXEMPLO22" name="user">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Mensagem</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="mensagem"></textarea>
</div>

<div>
<button class="btn btn-info float-end" type="submit" name="cadastro" value="Cadastro" >Enviar</button>
</div>

</form>


@endsection