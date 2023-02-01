@extends('layouts.main')
@section('titulo','Visualização de Noticias')
@section('conteudo')

<div class="container">
<h1>Visualização de Noticias</h1>
<form method="POST" action="{{route('savenoti')}}" enctype="multipart/form-data" class="bg-light p-5 rounded shadow m-5">
    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Titulo da notícia</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Titulo" name="titulo" value="{{$noticia->titulo}}" readonly>
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Imagem:</label>
  
  <div class="card" style="width: 18rem;">
    <img src="/img/publicnoticias/{{$noticia->imagem}}" class="card-img-top" alt="...">
  </div>
</div>
<div class="mb-3">
  <label for="descricao" class="form-label">Descrição:</label>
  <textarea class="form-control" id="descricao" rows="3" name="descricao" readonly>{{$noticia->descricao}}</textarea>
</div>

</form>
</div>
@endsection

