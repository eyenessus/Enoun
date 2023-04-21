@extends('Layout.main')
@section('titulo', 'Pedidos')
@section('conteudo')

<div class="container mx-auto max-w-screen-xl">

    <h1 class="text-5xl font-extrabold dark:text-white mx-5 ">Meus Pedidos</h1>

    @foreach ($pedidos as $pedido)

    <div class="relative overflow-x-auto my-8">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nº Pedido
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nome do produto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descricao
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantidade
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Valor Unidade
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Valor Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                        {{ $pedido->id }}

                    </th>
                    <td class="px-6 py-4">
                        <ul>
                            @foreach ($pedido->nome as $nome)
                            <li class="my-auto mx-auto">
                                {{ $nome }}
                                <hr>
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-6 py-4">
                      
                            @foreach ($pedido->descricao as $descricao)
                            <p class="w-64 truncate"> {{ $descricao }}</p>
                            
                            @endforeach
                        
                    </td>
                  
                    <td class="px-6 py-4">
                        @foreach ($pedido->quantidadeUnitaria as $quantidade)
                        <ul>
                            <li class="my-auto mx-auto">
                                {{ $quantidade }}
                            
                            </li>
                        </ul>
                        @endforeach
                    </td>
                    <td class="px-6 py-4 mx-auto">
                        @foreach ($pedido->valorUnitario as $valorUnidade)
                        <ul>
                            <li class="my-auto"> R$ {{number_format($valorUnidade, 2, ',', '.')}}</li>
                            <hr>
                        </ul>


                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        R$ {{number_format($pedido->valorTotal, 2, ',', '.')}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $pedido->status }}
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    @endforeach
    {{ $pedidos->links() }}
</div>

@endsection