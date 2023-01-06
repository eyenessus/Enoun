@extends('layouts.main')
@section('titulo',$resultadoNoticia->titulo)
@section('conteudo')
<div class="container">
<h1>
{{$resultadoNoticia->titulo}}
</h1>
<img src="/img/publicnoticias/{{$resultadoNoticia->imagem}}" />
<p>{{$resultadoNoticia->descricao}}</p>
</div>


@endsection