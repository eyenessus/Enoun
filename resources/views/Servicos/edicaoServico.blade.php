@extends('Layout.main')
@section('titulo','Edição de Serviço')
@section('conteudo')
<div class="mx-auto max-w-screen-xl">
    <button type="button" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">VOLTAR</button>
</div>
<div class="grid sm:grid-cols-2 gap-4 max-w-screen-xl mx-auto">
    <div class="my-8 mx-8 rounded-lg max-w-full ">
        <img src="https://s1.static.brasilescola.uol.com.br/be/conteudo/images/imagem-em-lente-convexa.jpg" alt="">
    </div>
    <div class="my-8 mx-8">
        <h1 class="text-5xl font-extrabold dark:text-white">iPhone 13 Pro Max</h1>
        <p class="max-w-lg text-3xl font-semibold leading-relaxed text-gray-900 dark:text-white">Descrição do produto
        </p>
        <div class="my-8 ">
            <button type="button"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Comprar</button>
        </div>
    </div>
</div>

@endsection