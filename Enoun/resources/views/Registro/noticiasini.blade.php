@extends('layouts.main')
@section('titulo','Registro de Noticias')
@section('conteudo')

<div class="container">
<h1>Registro de Noticias</h1>
<form method="POST" action="{{route('savenoti')}}" enctype="multipart/form-data">
@csrf
    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Titulo da notícia</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Titulo" name="titulo">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Imagem:</label>
  <input type="file" class="form-control" id="imagem" name="imagem">
</div>
<div class="mb-3">
  <label for="descricao" class="form-label">Descrição:</label>
  <textarea class="form-control" id="descricao" rows="3" name="descricao"></textarea>
</div>

<div class="mb-3">

 <button class="btn btn-success">Registrar</button>
</div>
</form>
</div>
@endsection

