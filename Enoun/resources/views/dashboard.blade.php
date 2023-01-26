@extends('layouts.main')
@section('titulo','DashBoard')
@section('conteudo')

<h1>Meus serviços</h1>


<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach($servico as $servicos)
      <tr>
        <th scope="row">{{$loop->index + 1}}</th>
        <td>{{$servicos->nome}}</td>
        <td>{{$servicos->descricao}}</td>
        <td>Editar | Excluir</td>
      </tr>
      @endforeach
    </tbody>
  </table>



@endsection