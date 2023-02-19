@extends('layouts.main')
@section('title', 'Resultado de busca')
@section('conteudo')

    <div class="container">

        @if (count($services) == 0 && $idbusca)
            <p>Não foi encontrado! Procure por alguma outra coisa semelhante com a palavra chave</p>
        @elseif(!$idbusca)
            <p> Digite alguma coisa para que seja exibido resultados correspondente </p>
        @else
            <h1 class="mt-2 text-white">Exibindo resultado de {{ $idbusca }}:</h1>


            <div class="row row-cols-1 row-cols-md-5 g-4 h-100 m-2">
                @foreach ($services as $valor)
                    <div class="col">
                        <div class="card h-100">
                            <img src="/img/publicserivces/{{ $valor->imagem }}" class="card-img-top" alt="{{ $valor->nome }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $valor->nome }}</h5>
                                <p class="card-text">{{ $valor->descricao }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif

        <h2 id="titulobusca" class="text-white">Sugestões:</h2>
    </div>

@endsection
