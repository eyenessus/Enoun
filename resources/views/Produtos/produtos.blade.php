@extends('Layout.main')
@section('titulo', 'Produtos')
@section('conteudo')


<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1
                class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                Seja surpreendido pela inovação tecnológica!</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Explore
                o
                melhor do mundo da tecnologia e encontre os produtos eletrônicos mais incríveis aqui, onde cada click é
                uma descoberta surpreendente!</p>


        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <img src="https://www.atacadogames.com/imagem/apple/celular-apple-iphone-14-pro-max-a2651-512gb-5g-esim-tela-6-7%27%27-cameras-de-48mp-12mp-12mp-e-12mp-gold/2/149668.jpg?pfdrid_c=true"
                alt="mockup">
        </div>
    </div>
</section>
@foreach ($produto as $produtos)

@endforeach
<div>
    <div class="container px-5 p-5 dark:bg-slate-900 mx-auto">
        @if(count($produto))
        @foreach ($categoria as $categorias)
        <div class="container px-5 p-5 dark:bg-slate-900 rounded">

            @if($produtos->categoria->nome == $categorias->nome)
            <h1 class="text-3xl text-bold dark:text-white">{{ $categorias->nome }}</h1>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-5 xl:grid-cols-4 sm:grid-cols-2 gap-5 pt-5 rounded">
                @foreach ($produto as $produtos)
                @if($produtos->categoria->nome == $categorias->nome)
                <div>
                    <div
                        class="w-full max-w-sm bg-white border border-gray-200  shadow dark:bg-slate-600 dark:border-gray-700 rounded">
                        <a href="{{ route('exibirProduto',$produtos->id) }}">
                            <img class="p-3 rounded-t-lg" src="/storage/{{ $produtos->imagem }}"
                                alt="{{ $produtos->nome }}" />
                        </a>
                        <div class="px-5 pb-5 mb-5">
                            <a href="{{ route('exibirProduto',$produtos->id) }}">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{
                                    $produtos->nome }}</h5>
                            </a>
                            <div class="flex items-center justify-between pt-5">
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">R${{ $produtos->valor
                                    }},00</span>
                            </div>
                            <div class="flex items-center justify-between pt-5">

                                <div class="ml-auto">
                                    <form action="{{ route('adicionar.produto',$produtos->id) }}" method="POST">
                                        @csrf
                                        <button
                                            class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">Comprar</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endforeach
        @endif
    </div>

</div>

@endsection