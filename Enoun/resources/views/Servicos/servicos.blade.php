@extends('layouts.main')
@section('titulo','Serviços')
@section('conteudo')
<h1>SERVIÇOS</h1>

<h2>Informática</h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach($serv as $servicos)
  @if($servicos->categoria == "informatica")  
  <div class="col">
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{$servicos->nome}}</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>

 
    @endif
    @endforeach
</div>








<h2>Desenvolvimento de website </h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach($serv as $servicos)
  @if($servicos->categoria == "developeweb")  
  <div class="col">
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{$servicos->nome}}</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  @else
 
    @endif
  
    @endforeach
</div>

<h2>Desenvolvimento de Aplicativos </h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach($serv as $servicos)
  @if($servicos->categoria == "developeApp")  
  <div class="col">
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{$servicos->nome}}</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
 

    @endif
    @endforeach
</div>

<h2>Sistemas Operacionais</h2>

<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach($serv as $servicos)
  @if($servicos->categoria == "system")  
  <div class="col">
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{$servicos->nome}}</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>

    @endif
    @endforeach
</div>

@endsection