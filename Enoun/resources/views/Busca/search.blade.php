@extends('layouts.main')
@section('title','Resultado de busca')
@section('conteudo')
@if($idbusca == null)
<p> Digite alguma coisa para que seja exibido resultados correspondente </p>
@elseif($idbusca == true)
<h1>Resultado de busca : {{$idbusca}}</h1>
<div class="container">
    <h1 id="titulobusca"></h1>
</div>

@endif

@endsection
