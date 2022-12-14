@extends('layouts.main')
@section('titulo','Serviços')
@section('conteudo')


<div class="container">
  <h1 class="pt-3">SERVIÇOS</h1>
<h2 id="informatica" class="mt-5">Informática</h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach($serv as $servicos)

  @if($servicos->categoria == "informatica")  
  <div class="col">
    <div class="card h-100">
      <img src="/img/publicserivces/{{$servicos->imagem}}" class="card-img-top" alt="...">
      <div class="card-body ">
        <h5 class="card-title">{{$servicos->nome}}</h5>
        <p class="card-text">{{$servicos->descricao}}</p>
        @foreach($servicos->inforextra as $servi)
        <p class="text-capitalize "> <i class="bi bi-check-circle-fill m-2" style="font-size: 30px; color: cornflowerblue;"></i>{{$servi}}</p>
        @endforeach
<a href="service/show/{{$servicos->id}}" class="btn btn-primary">Saiba mais</a>
      </div>
    </div>
  </div>
  @else
  <div class="card" aria-hidden="true">
  <img src="/img/build.jpeg" class="card-img-top" alt="...">
  <div class="card-body ">
    <h5 class="card-title placeholder-glow">
      <span class="placeholder col-6"></span>
    </h5>
    <p class="card-text placeholder-glow">
      <span class="placeholder col-7"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-6"></span>
      <span class="placeholder col-8"></span>
    </p>
        <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
  </div>
</div>
@endif
  @endforeach
</div>






<h2 id="webti" class="mt-5">Desenvolvimento de website </h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach($serv as $servicos)
  @if($servicos->categoria == "developeweb")  
  <div class="col">
    <div class="card h-100">
      <img src="/img/publicserivces/{{$servicos->imagem}}" class="card-img-top" alt="...">
      <div class="card-body ">
        <h5 class="card-title">{{$servicos->nome}}</h5>
        <p class="card-text">{{$servicos->descricao}}</p>
        @foreach($servicos->inforextra as $servi)
        <p class="text-capitalize "> <i class="bi bi-check-circle-fill m-2" style="font-size: 30px; color: cornflowerblue;"></i>{{$servi}}</p>
        @endforeach
         <a href="service/show/{{$servicos->id}}" class="btn btn-primary">Saiba mais</a>
      </div>
    </div>
  </div>
  @else
  <div class="card" aria-hidden="true">
  <img src="/img/build.jpeg" class="card-img-top" alt="...">
  <div class="card-body ">
    <h5 class="card-title placeholder-glow">
      <span class="placeholder col-6"></span>
    </h5>
    <p class="card-text placeholder-glow">
      <span class="placeholder col-7"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-6"></span>
      <span class="placeholder col-8"></span>
    </p>
        <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
  </div>
</div>
    @endif
  
    @endforeach
</div>

<h2 class="mt-5" >Desenvolvimento de Aplicativos </h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach($serv as $servicos)
  @if($servicos->categoria == "developeApp")  
  <div class="col">
    <div class="card h-100">
      <img src="/img/publicserivces/{{$servicos->imagem}}" class="card-img-top" alt="...">
      <div class="card-body ">
        <h5 class="card-title">{{$servicos->nome}}</h5>
        <p class="card-text">{{$servicos->descricao}}</p>
        @foreach($servicos->inforextra as $servi)
        <p class="text-capitalize "> <i class="bi bi-check-circle-fill m-2" style="font-size: 30px; color: cornflowerblue;"></i>{{$servi}}</p>
        @endforeach
         <a href="service/show/{{$servicos->id}}" class="btn btn-primary">Saiba mais</a>
      </div>
    </div>
  </div>
 
  @else
  <div class="card" aria-hidden="true">
  <img src="/img/build.jpeg" class="card-img-top" alt="...">
  <div class="card-body ">
    <h5 class="card-title placeholder-glow">
      <span class="placeholder col-6"></span>
    </h5>
    <p class="card-text placeholder-glow">
      <span class="placeholder col-7"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-6"></span>
      <span class="placeholder col-8"></span>
    </p>
        <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
  </div>
</div>
    @endif
    @endforeach
</div>

<h2 id="system" class="mt-5">Sistemas Operacionais</h2>

<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach($serv as $servicos)
  @if($servicos->categoria == "system")  
  <div class="col">
    <div class="card h-100">
      <img src="/img/publicserivces/{{$servicos->imagem}}" class="card-img-top" alt="...">
      <div class="card-body ">
        <h5 class="card-title">{{$servicos->nome}}</h5>
        <p class="card-text">{{$servicos->descricao}}</p>
        @foreach($servicos->inforextra as $servi)
        <p class="text-capitalize "> <i class="bi bi-check-circle-fill m-2" style="font-size: 30px; color: cornflowerblue;"></i>{{$servi}}</p>
        @endforeach
         <a href="service/show/{{$servicos->id}}" class="btn btn-primary">Saiba mais</a>
        
      </div>
    </div>
  </div>
  @else
  <div class="card" aria-hidden="true">
  <img src="/img/build.jpeg" class="card-img-top" alt="...">
  <div class="card-body ">
    <h5 class="card-title placeholder-glow">
      <span class="placeholder col-6"></span>
    </h5>
    <p class="card-text placeholder-glow">
      <span class="placeholder col-7"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-6"></span>
      <span class="placeholder col-8"></span>
    </p>
        <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
  </div>
</div>
    @endif
    @endforeach
</div>


</div>
@endsection