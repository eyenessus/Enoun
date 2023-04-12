@extends('Layout.main')
@section('titulo', 'Carrinho')
@section('conteudo')
@if(count($servico) || count($produto))
<div class="mx-8">
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
                
                @foreach ($produto as $produtos)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 mx-auto max-w-screen-xl">

                    <td class="w-32 p-4">
                        <img src="/storage/{{ $produtos->imagem }}" alt="{{ $produtos->nome }}">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{ $produtos->nome }}
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">


                            <form action="{{ route('decrementarProduto', $produtos->id) }}" method="POST">
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
                                    value="{{ $produtos->pivot['quantidade'] }}" disabled>
                            </div>

                            <form action="{{ route('adicionar.produto', $produtos->id) }}" method="POST">
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
                        R$ {{ $produtos->valor }},00
                    </td>

                    <td class="px-6 py-4">

                        <form action="{{ route('removerProduto', $produtos->id) }}" method="POST">

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
                        <img src="/storage/{{ $servicos->imagem }}" alt="{{ $servicos->nome }}">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{ $servicos->nome }}
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">


                            <form action="{{ route('decrementarServico', $servicos->id) }}" method="POST">
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
                                    value="{{ $servicos->pivot['quantidade'] }}" disabled>
                            </div>

                            <form action="{{ route('adicionar.servico', $servicos->id) }}" method="POST">
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

                        <form action="{{ route('removerServico', $servicos->id) }}" method="POST">

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


        <button type="button" data-modal-target="defaultModal" data-modal-toggle="defaultModal"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 float-right">Finalizar
            compra</button>
    </div>
</div>


<div id="defaultModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">

        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Resumo da compra
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="p-6 space-y-6">

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">

                            <tr>
                                @if(count($produto) <=0) <th scope="col" class="px-6 py-3 rounded-l-lg">
                                    SERVIÇOS
                                    </th>
                                    @endif
                                    <th scope="col" class="px-6 py-3 rounded-l-lg">
                                        Produtos
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantidade
                                    </th>
                                    <th scope="col" class="px-6 py-3 rounded-r-lg">
                                        Preço
                                    </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($servico) >0)

                            @foreach ($produto as $produtos)

                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $produtos->nome }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $produtos->pivot['quantidade'] }}
                                </td>
                                <td class="px-6 py-4">
                                    R$ {{number_format($produtos->valor, 2, ',', '.')}}
                                </td>
                            </tr>

                            @endforeach
                            @endif

                            @if(count($servico) >=0)
                            <tr>
                                <th scope="row" class="px-6 py-3 rounded-l-lg mt-8">
                                    SERVIÇOS
                                </th>
                            </tr>


                            @foreach ($servico as $servicos)

                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $servicos->nome }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $servicos->pivot['quantidade'] }}
                                </td>
                                <td class="px-6 py-4">
                                    R$ {{number_format($servicos->valor, 2, ',', '.')}}
                                </td>
                            </tr>

                            @endforeach
                            @endif

                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900 dark:text-white">
                                <th scope="row" class="px-6 py-3 text-base">Total</th>
                                <td class="px-6 py-3">

                                </td>
                                <td class="px-6 py-3">R$ {{number_format($totalProdutos+$totalServicos, 2, ',', '.')}}
                                </td>

                            </tr>
                        </tfoot>
                    </table>

                </div>


            </div>

            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="defaultModal" data-modal-target="crypto-modal" data-modal-toggle="crypto-modal"
                    type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Prosseguir</button>
                <button data-modal-hide="defaultModal" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Voltar</button>
            </div>
        </div>
    </div>
</div>




<div id="crypto-modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">

        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-hide="crypto-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <div class="px-6 py-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-base font-semibold text-gray-900 lg:text-xl dark:text-white">
                    Formas de pagamento
                </h3>
            </div>

            <div class="p-6">
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Faça o pagamento de forma mais rápida
                    de sua preferência com Mercado Pago!</p>
                <ul class="my-4 space-y-3">
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <img src="https://logospng.org/download/mercado-pago/logo-mercado-pago-icone-1024.png"
                                width="20px">
                            <span class="flex-1 ml-3 whitespace-nowrap">Mercado Pago</span>
                            <span
                                class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">Popular</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <img src="https://logospng.org/download/mercado-pago/logo-mercado-pago-icone-1024.png"
                                width="20px">
                            <span class="flex-1 ml-3 whitespace-nowrap">Boleto</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <img src="https://logospng.org/download/mercado-pago/logo-mercado-pago-icone-1024.png"
                                width="20px">
                            <span class="flex-1 ml-3 whitespace-nowrap">Pix</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <img src="https://logospng.org/download/mercado-pago/logo-mercado-pago-icone-1024.png"
                                width="20px">
                            <span class="flex-1 ml-3 whitespace-nowrap">Cartão de Crédito </span>
                        </a>
                    </li>
                </ul>

            </div>
            <div class="p-6">
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Faça o pagamento de forma mais rápida
                    de sua preferência com o Pagseguro</p>
                <ul class="my-4 space-y-3">
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <img src="https://companieslogo.com/img/orig/PAGS-db88593c.png?t=1593008230" width="20px">
                            <span class="flex-1 ml-3 whitespace-nowrap">PagSeguro</span>
                            <span
                                class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">Popular</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <img src="https://companieslogo.com/img/orig/PAGS-db88593c.png?t=1593008230" width="20px">
                            <span class="flex-1 ml-3 whitespace-nowrap">Boleto</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <img src="https://companieslogo.com/img/orig/PAGS-db88593c.png?t=1593008230" width="20px">
                            <span class="flex-1 ml-3 whitespace-nowrap">Pix</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <img src="https://companieslogo.com/img/orig/PAGS-db88593c.png?t=1593008230" width="20px">
                            <span class="flex-1 ml-3 whitespace-nowrap">Cartão de Crédito </span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <img src="https://companieslogo.com/img/orig/PAGS-db88593c.png?t=1593008230" width="20px">
                            <span class="flex-1 ml-3 whitespace-nowrap">Cartão de Débito </span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
@else
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">
                Sem itens</h1>
            <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">Adicione
                serviços e produtos</p>
            <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Desculpe, mas para conseguir ver os
                itens do carrinho e necessário que você adicione novos produtos ou serviços! </p>
            <a href="#"
                class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">Back
                to Homepage</a>
        </div>
    </div>
</section>

@endif


@endsection