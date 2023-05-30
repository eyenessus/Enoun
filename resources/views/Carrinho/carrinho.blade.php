@extends('Layout.main')
@section('titulo', 'Carrinho')
@section('conteudo')
<div class="container mx-auto max-w-screen-xl">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mx-auto">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Imagem</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        PRODUTO / SERVIÇO
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantidade
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Valor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ação
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($produto as $index =>$produtos)
            
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 mx-auto max-w-screen-xl">

                    <td class="w-32 p-4">
                        <a href="{{ route('produto.show',$produtos->id) }}">
                            <img src="/storage/{{ $produtos->imagem }}" alt="{{ $produtos->nome }}" class=" w-40 h-26">
                        </a>

                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        <a href="{{ route('produto.show',$produtos->id) }}">
                            {{ $produtos->nome }}
                        </a>
                    </td>



                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">


                            <form action="{{ route('produto.remove.store', $produtos->id) }}" method="POST">
                                @csrf
                                <button
                                    class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">

                                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </form>
                            <div>
                                <input type="number" id="first_product"
                                    class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ auth()->user() ? $produtos->pivot['quantidade']: $quantidadeP[$index+1] }}"
                                    disabled>
                           
                            </div>

                            <form action="{{ route('produto.add.store', $produtos->id) }}" method="POST">
                                @csrf
                                <button
                                    class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">

                                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </button>
                            </form>


                        </div>
                    </td>
                    <td class="px- py- font-semibold text-gray-900 dark:text-white">
                        R$ {{number_format($produtos->valor, 2, ',', '.')}}
                    </td>

                    <td class="px-6 py-4">

                        <form action="{{ route('produto.delete.destroy', $produtos->id) }}" method="POST">

                            @csrf
                            @method('DELETE')
                            <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Remover</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @foreach ($servico as $servicos)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <td class="w-32 p-4">
                        <a href="{{ route('servico.show',$servicos->id) }}">
                            <img src="/storage/{{ $servicos->imagem }}" alt="{{ $servicos->nome }}">
                        </a>

                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">

                        <a href="{{ route('servico.show',$servicos->id) }}">
                            {{ $servicos->nome }}
                        </a>
                    </td>


                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">


                            <form action="{{ route('servico.remove.store', $servicos->id) }}" method="POST">
                                @csrf
                                <button
                                    class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">

                                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </form>
                            <div>
                                <input type="number" id="first_product"
                                    class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ auth()->user() ? $servicos->pivot['quantidade'] : 435 }}" disabled>
                            </div>

                            <form action="{{ route('servico.add.store', $servicos->id) }}" method="POST">
                                @csrf
                                <button
                                    class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">

                                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </button>
                            </form>


                        </div>
                    </td>
                    <td class="px- py- font-semibold text-gray-900 dark:text-white">
                        R$ {{number_format($servicos->valor, 2, ',', '.')}}
                    </td>

                    <td class="px-6 py-4">

                        <form action="{{ route('servico.delete.destroy', $servicos->id) }}" method="POST">

                            @csrf
                            @method('DELETE')
                            <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Remover</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>

            <tfoot>
                <tr class="font-semibold text-gray-900 dark:text-white ">
                    <th scope="row" class="px-6 py-3 text-base ">Total</th>
                    <td>R$ {{number_format($totalProdutos+$totalServicos, 2, ',', '.')}}</td>

                </tr>
            </tfoot>
        </table>

        @auth

        <div class="mx-8 my-8 ">
            <label class="block">
                <span class=" after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700 " id="teste">
                    Cupom de desconto
                </span>
                <input type="text" name="cupom" id="cupom"
                    class="w-75  mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1"
                    placeholder="EXEMPLO19" value="" />
                <div id="situacaoCupom" role="alert">
                </div>
                <button type="button" id="botaoVerificarCupom"
                    class=" my-2 mx-2 text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Aplicar
                    cupom</button>
            </label>
        </div>
        @endauth

        <button type="button" data-modal-target="defaultModal" data-modal-toggle="defaultModal"
            class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-2">
            <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                </path>
            </svg>Finalizar
            compra</button>
    </div>
</div>
@endsection