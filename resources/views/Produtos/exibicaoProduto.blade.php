@extends('Layout.main')
@section('titulo',$produto['nome'])
@section('conteudo')
<a href="{{ url()->previous() }}">
    <button type="button" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">VOLTAR</button>
</a>
<div class="grid sm:grid-cols-2 gap-4 max-w-screen-xl mx-auto">
    <div class="my-8 mx-8 rounded-lg max-w-full ">
        <img src="/storage/{{ $produto['imagem'] }}" alt="">
    </div>
    <div class="my-8 mx-8">
        <h1 class="text-5xl font-extrabold dark:text-white my-8">{{ $produto['nome'] }}</h1>
        <h1>Descrição do produto</h1>
        <p class="max-w-lg text-3xl font-semibold leading-relaxed text-gray-900 dark:text-white">{{ $produto['descricao'] }}
        </p>
        <div class="my-8 ">
            <form action="{{ route('produto.add.store',$produto['id']) }}" method="POST">
                @csrf
                <button type="submit"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Comprar</button>
            </form>
        </div>
            </a>
    </div>
    
</div>




@endsection