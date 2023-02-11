@extends('layouts.main')
@section('titulo', 'Visualização de Noticias')
@section('conteudo')

    <div class="container">

        <div class="bg-light p-4 m-1 mt-5 mb-5 rounded shadow card w-100 ">
            <h1>Visualização de Noticias</h1>
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo da notícia</label>
                <input type="text" class="form-control-plaintext" id="exampleFormControlInput1" placeholder="Titulo"
                    name="titulo" value="{{ $noticia->titulo }}" readonly>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem:</label>

                <div class="card p-2  " style="width: 18rem;">
                    <img src="/img/publicnoticias/{{ $noticia->imagem }}">
                </div>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <input type="text" class="form-control-plaintext" id="descricao" rows="3" name="descricao" readonly
                    value="{{ $noticia->descricao }}" />
            </div>

        </div>
    </div>
@endsection
