@extends('layouts.main')
@section('titulo',$resultadoId->nome)
@section('conteudo')
<div class="container">

<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="/img/publicserivces/{{$resultadoId->imagem}}" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{$resultadoId->nome}}</h5>
        <p class="card-text">{{$resultadoId->descricao}} </p>
        <p class="card-text"><small class="text-muted">{{$resultadoId->categoria}}</small></p>
      </div>
    </div>
  </div>
</div>

</div>










@endsection