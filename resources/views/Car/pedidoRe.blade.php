@extends('layouts.main')
@section('titulo', 'Carrinho de compras')
@section('conteudo')


<div class="container bg-orange-200 mt-5">
<h1>Seus pedidos realizados</h1>
    <table class="table table-primary table-responsive-sm">
      <thead>
    <tr>
      <th scope="col">Número do pedido</th>
      <th scope="col">Nome</th>
      <th scope="col">Descrição</th>
      <th scope="col">Quantidade</th>
      <th scope="col">Valor final</th>
      <th scope="col">Data</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Computador</td>
      <td>Apple</td>
      <td>90</td>
      <td>10</td>
      <td>10/09/22</td>
    </tr> 
    
  </tbody>
  
      </table>




</div>





@endsection