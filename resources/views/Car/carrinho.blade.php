@extends('layouts.main')
@section('titulo','Carrinho de compras')
@section('conteudo')
<div class="container">
 <div>
 </div>
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
    
       
    @foreach ($addItem as $valuer)
          <tr>
            <th scope="row">{{$valuer->id}}</th>
            <td>{{$valuer->nome}}</td>
            <td>11,00</td>
            <td>APAGAR</td>
          </tr>
          @endforeach
     
        </tbody>
      

      <td colspan="4"> <span class="float-end">Valor Total: R$ {{number_format(count($addItem),2,',','.')}}</span></td>  
      </table>
      <div class="p-2 pb-5">
        <button class="btn btn-success float-end "> Finalizar Pedido</button>
      </div>

      
</div>

@endsection