@extends('layouts.main')
@section('titulo','Carrinho de compras')
@section('conteudo')
<div class="container">
    
    <table class="table table-auto table-light table-hover table-bordered m-2">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Descrição</th>
            <th scope="col">Valor</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td></td>
            <td></td>
            <td></td>
          </tr>
         
        </tbody>
    
      <td colspan="4"> <span class="float-end">Valor Total: 00,00</span></td>  
      </table>
      <div class="p-2 pb-5">
        <button class="btn btn-success float-end "> Finalizar Pedido</button>
      </div>

      
</div>

@endsection