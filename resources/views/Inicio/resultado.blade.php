@extends('layouts.main')
@section('titulo', $resultadoNoticia->titulo)
@section('conteudo')
    <div class="container bg-light p-1 mt-5 mb-5 w-75">
        <img class="img-fluid img-thumbnail rounded mx-auto d-block noticias mt-3"
            src="/img/publicnoticias/{{ $resultadoNoticia->imagem }}" />
            <h1 class="text-center">
                {{ $resultadoNoticia->titulo }}
            </h1>
        <p class="text-center bg-light text-dark">{{ $resultadoNoticia->descricao }}</p>
        <p>Publicado por: {{ $autor['name'] }}.</p>
    </div>

@endsection
