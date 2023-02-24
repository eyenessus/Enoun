@extends('layouts.main')
@section('titulo','Registro de slide')
@section('conteudo')

<div class="container">

    <form method="POST" action="{{route('registroSlide')}}" enctype="multipart/form-data"
        class="bg-light p-5 rounded shadow m-5">
        <h1>Registro de Slides</h1>
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Titulo de Slide</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Titulo" name="titulo">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Imagem:</label>
            <input type="file" class="form-control" id="imagem" name="imagem">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea class="form-control" id="descricao" rows="3" name="descricao"></textarea>
        </div>

        <div class="mb-3">
            <button class="btn btn-success">Registrar Slide</button>
        </div>
    </form>
</div>

@endsection