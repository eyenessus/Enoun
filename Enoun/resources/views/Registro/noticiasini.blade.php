@extends('layouts.main')
@section('titulo','Registro de Noticias')
@section('conteudo')

<div class="container">
<h1>Registro de Noticias</h1>
<form method="POST" action="{{route('savenoti')}}" enctype="multipart/form-data">
    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Titulo da notícia</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Titulo">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Imagem:</label>
  <input type="file" class="form-control" id="exampleFormControlInput1">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Descrição:</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>

<div class="mb-3">

 <button class="btn btn-success">Registrar</button>
</div>
</form>
</div>
@endsection

