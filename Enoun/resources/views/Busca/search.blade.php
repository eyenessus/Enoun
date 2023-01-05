@extends('layouts.main')
@section('title','Resultado de busca')
@section('conteudo')
@if($idbusca == null)
<p> Digite alguma coisa para que seja exibido resultados correspondente </p>
@elseif($idbusca == true)
<h1>Resultado de busca : {{$idbusca}}</h1>
@endif

@endsection
