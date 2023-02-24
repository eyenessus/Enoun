@extends('layouts.main')
@section('titulo', 'Pedidos')
@section('conteudo')


    <div class="container mt-5">
        <div class="text-center ">
            <h1><i class="bi bi-box-seam-fill text-white "></i></h1>
        </div>
        <h1 class="text-white fw-bolder text-center text-md-start">Seus pedidos realizados</h1>
        
     
        @foreach ($listaDePedidos as $valor)
        <div class="table-responsive">
            <table class="table table-light text-center">
               
                <thead>
                    <tr>
                        <th scope="col">ID</th>

                        <th scope="col">Descrição</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Valor Unitário</th>
                        <th scope="col">Valor final</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th scope="row"> {{ $valor->id }}</th>


                        <td>
                            @foreach ($valor->descricao as $descricao)
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center m-1">
                                        {{ $descricao }}
                                    </li>
                                </ul>
                            @endforeach
                        </td>
                        <td>
                            
                                @foreach ($valor->quantidadeUnitaria as $valorU)
                                <ul class="list-group">
                                  
                                  <li class="list-group-item p-4 p-md-2 m-1 mt-3 mt-md-1 "><i class="bi bi-arrow-left d-md-none text-danger"></i> {{$valorU}}</li>
                                </ul>
                                @endforeach
                           
                        </td>
                        <td>

                            <ul class="list-group">
                                @foreach ($valor->valorUnitario as $valorU)
                                    <li class="list-group-item m-1"><span>R$ {{ $valorU }},00</span></li>
                                @endforeach
                            </ul>

                        </td>



                        <td> <span class="badge bg-primary rounded-pill"> R$ {{ $valor->valor }}</span> </td>
                        <td> {{ $valor->created_at }}</td>
                    </tr>
                </tbody>

            </table>   
        </div>
          
        @endforeach
        <div class="text-end m-5 text-decoration-none">
            {{ $listaDePedidos->links() }}
        </div>
    </div>



@endsection
