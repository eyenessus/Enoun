@extends('layouts.main')
@section('titulo', 'Carrinho de compras')
@section('conteudo')

    <script>
        {{ $valorFinal = null }}
        @foreach ($addItem as $valores)
            {{ $valorFinal += $valores['preco'] * $valores->pivot['quantidade'] }}
        @endforeach
    </script>

    <div class="container">


        <div>
        </div>
        <div class="text-center float-end m-2">
            <button class="btn btn-info text-white text-capitalize">
                <a href="{{ route('pedidos') }}" class=" text-white text-capitalize text-decoration-none">Meus pedidos
                    realizados</a>
            </button>
        </div>
        <table class="table table-auto table-light table-hover table-bordered m-2 mt-5 table-responsive">
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
                        <td>{{ $valuer->nome }}</td>
                        <td>R$ <span id="valorItem"> {{ $valuer->preco }}</span>,00</td>
                        <th scope="row"> <input type="number" value="{{ $valuer->pivot['quantidade'] }}"
                                class="text-center"></th>
                        <td>




                            <form action="serviceDeletCar/{{ $valuer->id }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger"> <i class="  float-end bi bi-trash3-fill"> Deletar</i>
                                </button>

                            </form>


                        </td>
                    </tr>
                @endforeach

            </tbody>



            <td colspan="4"> <span class="float-end">Valor Total: R$ {{ number_format($valorFinal, 2, ',', '.') }}</span>
            </td>

        </table>

        <div class="p-2 pb-5">
            <button class="btn btn-success float-end " data-bs-toggle="modal" data-bs-target="#exampleModal"> Finalizar
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
                                <th>{{ $valuer->nome }}</th>
                                <td>R${{ number_format($valuer->preco, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach

                    </table>

                    <h6>Valor Total: R$ {{ number_format($valorFinal, 2, ',', '.') }}</h6>
                    <div class="p-3">

                        <label for="bandeira">Bandeira</label>

                        <div class="d-flex m-2">
                            <div class="form-check m-1">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Visa
                                </label>
                            </div>
                            <div class="form-check m-1">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Mastercard
                                </label>
                            </div>

                        </div>


                        <label>Nome escrito no cartão</label>
                        <input class="form-control form-control-sm" type="text">

                        <label>Numero do cartão</label>
                        <input class="form-control form-control-sm" type="text">

                        <label>Codigo de segurança</label>
                        <input class="form-control form-control-sm " type="text">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                            checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Cartão de credito
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Cartão de debito
                        </label>
                    </div>

                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="99"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 75%"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                    <form action="{{ route('finalizarp') }}" method="POST">
                        @csrf
                        <input type="hidden" name="valor" id="valor" value="{{ $valorFinal }}">

                        @foreach ($addItem as $valuer)
                            <input type="hidden" id="descricao" value="{{ $valuer->nome }}" name="descricao[]">
                        @endforeach

                        <button class="btn btn-primary">Finalizar pedido</button>
                    </form>


                </div>
            </div>
        </div>
    </div>





    <?php
    require_once 'C:\Users\eyeth\Desktop\Enoun\vendor\autoload.php'; // You have to require the library from your Composer vendor folder
    MercadoPago\SDK::setAccessToken('TEST-4916438875999206-020812-1f00891690dc9573a59ecc3bdac77ffd-358481091'); // Either Production or SandBox AccessToken
    
    $payment = new MercadoPago\Payment();
    
    $payment->transaction_amount = 141;
    $payment->token = '';
    $payment->description = 'Ergonomic Silk Shirt';
    $payment->installments = 1;
    $payment->payment_method_id = 'visa';
    $payment->payer = [
        'email' => 'larue.nienow@email.com',
    ];
    
    $payment->save();
    
    echo $payment->status;
    ?>





@endsection
