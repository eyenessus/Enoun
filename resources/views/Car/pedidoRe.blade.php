@extends('layouts.main')
@section('titulo', 'Pedidos')
@section('conteudo')


    <div class="container bg-orange-200 mt-5">
        <h1>Seus pedidos realizados</h1>
        @foreach ($item as $valor)
            <table class="table table-primary table-responsive-sm">
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
                        <th scope="row">{{ $valor->id }}</th>

                   
                            <td>{{$valor->pivot['servicos_identificao']}}</td>
                      
                        <td>R$ {{$valor->pivot['valor']}}</td>
                        <td>{{ $valor->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>

@endsection
