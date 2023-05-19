@extends('Layout.main')
@section('titulo', 'Início')
@section('conteudo')

<div class="container mx-auto max-w-screen-xl p-5">

    <h1 class="text-5xl font-extrabold dark:text-white">Todos<small
            class="ml-2 font-semibold text-gray-500 dark:text-gray-400">resultados encontrado: </small></h1>
    @if(count($busca['produtos']) >= 1)
    <h3 class="text-3xl font-bold dark:text-white mt-12">Produtos encontrados:</h3>
    <div class="grid grid-cols-1 md:grid-cols-5 xl:grid-cols-4 sm:grid-cols-2 gap-5  rounded">
        @foreach ($busca['produtos'] as $buscas)
        <div
            class="w-full my-8 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="{{ route('produto.show',$buscas->id) }}">
                <img class="p-8 rounded-t-lg" src="/storage/{{ $buscas->imagem }}" alt="product image" />
            </a>
            <div class="px-5 pb-5">
                <a href="{{ route('produto.show',$buscas->id) }}">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $buscas->nome }}
                    </h5>
                </a>

                <div class="flex items-center justify-between my-8">
                    <span class="text-3xl font-bold text-gray-900 dark:text-white">R$ {{ number_format($buscas->valor,
                        2, ',', '.')}}</span>

                </div>
                <div class="float-right">
                    <form action="{{ route('produto.add.store',$buscas->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Adicionar
                            no carrinho</button>

                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif


    @if(count($busca['servicos']) >= 1)

    <h3 class="text-3xl font-bold dark:text-white">Serviços encontrados:</h3>

    <div class="grid grid-cols-1 md:grid-cols-5 xl:grid-cols-4 sm:grid-cols-2 gap-5  rounded">
        @foreach ($busca['servicos'] as $buscas)
        <div
            class="w-full my-8 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="{{ route('servico.show',$buscas->id) }}">
                <img class="p-8 rounded-t-lg" src="/storage/{{ $buscas->imagem }}" alt="product image" />
            </a>
            <div class="px-5 pb-5">
                <a href="{{ route('servico.show',$buscas->id) }}">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $buscas->nome }}
                    </h5>
                </a>

                <div class="flex items-center justify-between my-8">
                    <span class="text-3xl font-bold text-gray-900 dark:text-white">R$ {{ number_format($buscas->valor,
                        2, '.', ',')}}</span>

                </div>
                <div class="float-right">
                    <form action="{{ route('servico.add.store',$buscas->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Adicionar
                            no carrinho</button>

                    </form>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    @endif
</div>

@endsection