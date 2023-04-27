@extends('Layout.main')
@section('titulo','Edição de Serviço')
@section('conteudo')
<div class="mx-auto max-w-screen-xl">
    <section class="bg-white dark:bg-gray-900">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <li class="dark:text-white">{{ $error }}</li>
        @endforeach
        @endif
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Atualização de serviço {{ $servico['nome'] }}
            </h2>
            <form action="{{ route('servico.update',$servico['id'])}}" method="POST"
                enctype="multipart/form-data" class="p-5 border rounded">
                @csrf
                @method('PUT')
    
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do
                            servico</label>
                        <input type="text" name="nome" id="nome"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $servico['nome'] }}" placeholder="Nome do servico" required="">
                    </div>
                
                    <div class="w-full">
                        <label for="valor"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor</label>
                        <input type="number" name="valor" id="valor"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $servico['valor'] }}" placeholder="$299" required="">
                    </div>
                    <div>
                        <label for="categoria"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria</label>
                        <select id="categoria"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            name="categoria_id">
    
    
                            <option selected="" value="{{$servico['categoria_id']}}">Sem alterações</option>
    
                         
                               @foreach ($categoria as $categorias)
                               <option value="{{ $categorias->id }}">{{ $categorias->nome }}</option>
                               @endforeach
                          
                          
    
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="codigo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Codigo</label>
                        <input type="number" name="codigo" id="codigo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $servico['codigo'] }}" placeholder="R$299.10" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="descricao"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descricao</label>
                        <textarea id="descricao" rows="8"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            name="descricao" placeholder="Escreva sua descrição aqui">{{ $servico['descricao'] }}</textarea>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <img src="/storage/{{ $servico['imagem'] }}" alt="{{ $servico['nome'] }}">
                    <div class="my-8">
                        <input type="file" name="imagem" id="imagem">
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atualizar Serviço</button>

    
                </div>
            </form>
        </div>
    </section>
</div>


@endsection