@extends('Layout.main')
@section('titulo','Edição de Produto')
@section('conteudo')
<section class="bg-white dark:bg-gray-900">
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Atualização de produto {{ $produto['nome'] }}</h2>
        <form action="{{ route('produto.update',$produto['id'])}}" method="POST" enctype="multipart/form-data" class="border p-5 rounded">
            <x-alert/>
            @method('PUT')
            <div class="sm:col-span-2">
                <img class="h-24"  src="/storage/{{ $produto['imagem'] }}" alt="{{ $produto['nome'] }}">
            </div>
            @include('Produtos.Partes.form',['produto'=>$produto,'categorias'=>$categorias])
            <div class="flex items-center space-x-4">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atualizar produto</button>
            </div>
        </form>
    </div>
  </section>
@endsection