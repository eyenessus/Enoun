@extends('layouts.main')
@section('titulo', $resultadoNoticia->titulo)
@section('conteudo')
    <div class="container">
        <h1 class="text-center">
            {{ $resultadoNoticia->titulo }}
        </h1>
        <img class="img-fluid img-thumbnail rounded mx-auto d-block noticias"
            src="/img/publicnoticias/{{ $resultadoNoticia->imagem }}" />
        <p class="text-center bg-light text-dark">{{ $resultadoNoticia->descricao }}</p>
        <p>Publicado por: {{ $buscaFilttrada['name'] }} </p>
    </div>

@endsection
