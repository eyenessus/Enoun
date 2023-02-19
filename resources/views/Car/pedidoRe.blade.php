@extends('layouts.main')
@section('titulo', 'Pedidos')
@section('conteudo')


    <div class="container bg-orange-200 mt-5">
        <h1 class="text-white">Seus pedidos realizados</h1>
        @foreach ($teste as $valor)
            <table class="table table-light table-responsive-sm text-center ">
                <thead>
                    <tr>
                        <th scope="col">Número do pedido</th>

                        <th scope="col">Descrição</th>

                        <th scope="col">Valor final</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th scope="row"> {{ $valor->id }}</th>

                       
                            <td>
                                @foreach ($valor->descricao as $ok)
                                <div class="bg-info text-white border rounded-2 m-2 text-bold text-start p-2">
                                    
                                    {{ $ok }} 
                                   
                                </div>
                                @endforeach
                            </td>
                       


                        <td>R$ {{ $valor->valor }} </td>
                        <td> {{ $valor->created_at }}</td>
                    </tr>
                </tbody>
            </table>
           
        @endforeach
       <div class="text-end m-5">
        {{$teste->links()}}
       </div>
    </div>

@endsection
