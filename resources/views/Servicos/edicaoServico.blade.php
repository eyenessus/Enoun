@extends('Layout.main')
@section('titulo','Edição de Serviço')
@section('conteudo')
<div class="mx-auto max-w-screen-xl">
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Atualização de serviço {{ $servico['nome'] }}
            </h2>
            <form action="{{ route('servico.update',$servico['id'])}}" method="POST"
                enctype="multipart/form-data" class="p-5 border rounded">
                <div class="sm:col-span-2">
                    <img class="h-24" src="/storage/{{ $servico['imagem'] }}" alt="{{ $servico['nome'] }}">
                </div>
                @include('Servicos.Partes.form',['servico'=>$servico,'categorias'=>$categorias])
                @method('PUT')
    
                <div class="flex items-center space-x-4 my-8">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atualizar Serviço</button>
                </div>
            </form>
        </div>
    </section>
</div>


@endsection