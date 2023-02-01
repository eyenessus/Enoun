@extends('layouts.main')
@section('titulo',$resultadoId->nome)
@section('conteudo')
<div class="container-fluid p-5">
  <div class="bg-light rounded mb-3">
    <img src="/img/publicserivces/{{$resultadoId->imagem}}" id="resultadoimagem" class="rounded shadow ml-5" alt="...">
    <div class="">
      <h1 class="card-title text-info text-center">{{$resultadoId->nome}}</h1>
      <p class="text-uppercase p-3">{{$resultadoId->descricao}}</p>
      <p class="text-uppercase p-2"><small class="text-muted">{{$resultadoId->categoria}}</small></p>
      <div>
        Publico por: {{$donoDoServico['name']}}
      </div>
    </div>
  </div>

<div> 
<h6>Comentários:</h6>
<div class=" border-5" id="comentariosServicos">
  
</div>
</div>
</div>










@endsection