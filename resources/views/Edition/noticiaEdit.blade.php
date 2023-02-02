@extends('layouts.main')
@section('titulo','Edição de Noticias')
@section('conteudo')

<div class="container">

<form method="POST" action="/editarNoticia/update/{{$noticia->id}}" enctype="multipart/form-data" class="bg-light p-4 m-1 mt-5 mb-5 rounded shadow card w-100">
@csrf
<h1>Edição de Noticias</h1>
@method('PUT')
    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Titulo da notícia</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Titulo" name="titulo" value="{{$noticia->titulo}}">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Imagem:</label>
  
  <input type="file" class="form-control" id="imagem" name="imagem">
  <div class="card mt-2" style="width: 18rem;">
    <img src="/img/publicnoticias/{{$noticia->imagem}}" class="card-img-top" alt="...">
  </div>
</div>
<div class="mb-3">
  <label for="descricao" class="form-label">Descrição:</label>
  <textarea class="form-control" id="descricao" rows="3" name="descricao">{{$noticia->descricao}}</textarea>
</div>

<div class="mb-3">
 <button class="btn btn-success">Registrar</button>
</div>
</form>
</div>
@endsection

