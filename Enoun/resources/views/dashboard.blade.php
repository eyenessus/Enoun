@extends('layouts.main')
@section('titulo','DashBoard')
@section('conteudo')

<h1>Meus serviços</h1>

<div class="container">
  <table class="table">
    <h2>Tabelas de Servicos que foram registrados</h2>
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Descricao</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
          @foreach($servico as $servicos)
        <tr>
          <th scope="row">{{$loop->index + 1}}</th>
          <td>{{$servicos->nome}}</td>
          <td>{{$servicos->descricao}}</td>
          <td>

            <div>
              <form action="serviceDelete/{{$servicos->id}}" method="POST">
                @csrf
               
                <button type="submit"><i class="bi bi-pencil-square"></i></button>
              </form>
  
            </div>

            <div>
  
              <form action="serviceDelete/{{$servicos->id}}" method="POST">
                @csrf
                @method("DELETE")
                <button type="submit"><i class="bi bi-trash3-fill"></i></button>
              </form>
            </div>

         
          

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  
    <table class="table">
      <h2>Tabelas de Noticias que foram registrados</h2>
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Descricao</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach($noticias as $note)
          <tr>
            <th scope="row">{{$loop->index + 1}}</th>
            <td>{{$note->titulo}}</td>
            <td>{{$note->descricao}}</td>
            <td>

        <div>
          <form action="serviceDelete/{{$note->id}}" method="POST">
            @csrf
           
            <button type="submit"><i class="bi bi-pencil-square"></i></button>
          </form>

        </div>

           <div>
            <form action="" method="POST">
              @csrf
              @method("DELETE")
              <button type="submit"><i class="bi bi-trash3-fill"></i></button>
            </form>

           </div>

              
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>


@endsection