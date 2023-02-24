@extends('layouts.main')
@section('titulo', 'Visualizador de Serviços')
@section('conteudo')

    <div class="container">

        <div class="bg-light p-4 m-1 mt-5 mb-5 rounded shadow card w-100">
            <h1>Visualização de serviço</h1>

            <div class="mb-3">
                <label for="nome" class="form-label">Titulo do serviço</label>

                <input type="text" class="form-control-plaintext font-bold text-uppercase" id="nome" name="nome"
                    placeholder="Titulo" value="{{ $servico->nome }}" readonly>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem:</label>

                <div class="card" style="width: 18rem;">
                    <img src="/img/publicserivces/{{ $servico->imagem }}" class="card-img-top" alt="...">

                </div>

            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" name="categoria" value="{{ $servico->categoria }}" disabled>
                    <option value="informatica">Informática</option>
                    <option value="developeweb">Desenvolvimento web</option>
                    <option value="developeApp">Desenvovilmento Mobile</option>
                    <option value="system">Sistema operacionais</option>
                </select>
            </div>


        </div>

    </div>

@endsection
