@extends('layouts.main')
@section('titulo', 'Carrinho de compras')
@section('conteudo')

   

    <div class="container">


        <div>
        </div>
        <div class="text-center float-end m-2">
            <button class="btn btn-info text-white text-capitalize ">
                <a href="{{ route('pedidos') }}" class=" text-white text-capitalize text-decoration-none"><i class="bi bi-box-seam-fill"></i> Meus pedidos
                    </a>
            </button>
        </div>
        <table class="table table-auto table-light table-hover table-border table-responsive border border-white mb-5 mt-5">
            <thead>
                <tr class="text-center">

                    <th scope="col">Descrição</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($addItem as $valuer)
                    <tr class="text-center">
                        <td class="text-uppercase fw-bold">{{ $valuer->nome }}</td>
                        <td>R$ <span id="valorItem"> {{ $valuer->preco }}</span>,00</td>
                        <th scope="row"> 
                            <button class="btn btn-info text-white">
                                <i class="bi bi-basket2 p-2"></i>
                                <span class="badge bg-white rounded-pill text-dark">{{ $valuer->pivot['quantidade'] }}</span>
                            </button>
                            
                                </th>
                        <td>
                            <div class="row">


                                <div class="col m-1">
                                    <form action="{{route('diminuirItem',$valuer->id)}}" method="GET">
                                        <button class="btn btn-warning text-white">  <i class="bi bi-bag-dash"></i>
                                        </button>
                                    </form>
                                   

                                </div>

                                <div class="col m-1">

                                    <form action="/removerDoCarrinho/{{ $valuer->id }}" method="POST">

                                        @csrf
                                        @method('DELETE')
        
                                        <button class="btn btn-danger"> <i class="  float-end bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="col m-1">
                                    <form action="{{route('aumentarItem',$valuer->id)}}" method="GET">
                                        <button class="btn btn-success text-white">
                                            <i class="bi bi-bag-plus"></i>
                                        </button>
                                    </form>
                                   

                                </div>

                            </div>

                            


                        </td>
                    </tr>
                @endforeach

            </tbody>



            <td colspan="4" class="text-success"> <span class="float-end ">Valor Total: R$ {{ number_format($valorFinal, 2, ',', '.') }}</span>
            </td>

        </table>

        <div class="p-2 pb-5 mb-5">
            <div>
            {{$addItem->links()}}
            </div>
            <button class="btn btn-success float-end botaopross " data-bs-toggle="modal" data-bs-target="#exampleModal" desable> Finalizar
                Pedido</button>
        </div>
    </div>

    

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Finalizando pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table class="table table-sm">
                        @foreach ($addItem as $valuer)
                            <tr>
                                <th>{{ $valuer->pivot['quantidade'] }}</th>
                                <th>{{ $valuer->nome }}</th>
                                <td class="mt-2">R${{ number_format($valuer->preco, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach

                    </table>

                    <h6 >Valor Total: R$ <span class="valorFinal">{{ number_format($valorFinal, 2, ',', '.') }}</span></h6>
                  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
               

                        <button class="btn btn-primary">
                            <a href="{{route('finalizarPedido')}}" class="text-center text-white text-decoration-none"> Finalizar pedido</a>
                      </button>
                


                </div>
            </div>
        </div>
    </div>




@endsection
