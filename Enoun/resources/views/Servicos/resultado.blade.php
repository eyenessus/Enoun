@extends('layouts.main')
@section('titulo',$resultadoId->nome)
@section('conteudo')
<div class="container">
  <h1 class="card-title text-uppercase">{{$resultadoId->nome}}</h1>
  <div class="card mb-3">
    <img src="/img/publicserivces/{{$resultadoId->imagem}}" class="card-img-top" alt="...">
    <div class="card-body">
      <p class="card-text">{{$resultadoId->descricao}}</p>
      <p class="card-text"><small class="text-muted">{{$resultadoId->categoria}}</small></p>
    </div>
  </div>


</div>










@endsection