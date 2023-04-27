@extends('Layout.main')
@section('titulo','Edição de Produto')
@section('conteudo')
<section class="bg-white dark:bg-gray-900">
    @if ($errors->any())       
    @foreach ($errors->all() as $error)
    <li class="dark:text-white">{{ $error }}</li>

@endforeach
@endif
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Atualização de produto {{ $produto['nome'] }}</h2>
        <form action="{{ route('produto.update',$produto['id'])}}" method="POST" name="oioi" enctype="multipart/form-data" class="border p-5 rounded">
            @csrf
            @method('PUT')
            
            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                <div class="sm:col-span-2">
                    <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do produto</label>
                    <input type="text" name="nome" id="nome" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $produto['nome'] }}" placeholder="Nome do produto" required="">
                </div>
                <div class="w-full">
                    <label for="marca" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marca</label>
                    <input type="text" name="marca" id="marca" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $produto['marca'] }}" placeholder="Nome da marca" required="">
                </div>
                <div class="w-full">
                    <label for="valor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor</label>
                    <input type="number" name="valor" id="valor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $produto['valor'] }}" placeholder="$299" required="">
                </div>
                <div>
                    <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria</label>
                    <select id="categoria" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="categoria_id">
                     
                    
                        <option selected="{{ $produto['categoria_id'] }}" value="{{ $produto['categoria_id'] }}">Sem alterações </option>
                      
                        @foreach ($categoria as $categorias)
                        <option value="{{ $categorias->id }}">{{ $categorias->nome }}</option>
                      @endforeach
                       
                    </select>
                </div>
                <div class="w-full">
                    <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Codigo</label>
                    <input type="number" name="codigo" id="codigo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $produto['codigo'] }}" placeholder="R$299.10" required="">
                </div>
                <div class="sm:col-span-2">
                    <label for="descricao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descricao</label>
                    <textarea id="descricao" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="descricao" placeholder="Escreva sua descrição aqui">{{ $produto['descricao'] }}</textarea>
                </div>
            </div>
            <div class="sm:col-span-2">
                <img  src="/storage/{{ $produto['imagem'] }}" alt="{{ $produto['nome'] }}">
               <div class="my-8">
                <input type="file" name="imagem" id="imagem">
               </div>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atualizar produto</button>

                
            </div>
        </form>
    </div>
  </section>
@endsection