@extends('layouts.main')
@section('titulo','Registro de Noticias')
@section('conteudo')

<div class="container">
<h1>Registro de serviços</h1>
<form method="POST" action="{{route('saveservice')}}" enctype="multipart/form-data">
    <div class="mb-3">
  <label for="titulo" class="form-label">Titulo do serviço</label>
  <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
</div>
<div class="mb-3">
  <label for="imagem" class="form-label">Imagem:</label>
  <input type="file" class="form-control" id="imagem" name="imagem">
</div>
<div class="mb-3">
  <label for="descricao" class="form-label">Descrição:</label>
  <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
</div>

<div class="mb-3">

 <button class="btn btn-success">Registrar</button>
</div>
</form>
</div>
@endsection




