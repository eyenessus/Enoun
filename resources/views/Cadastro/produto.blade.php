@extends('Layout.main')
@section('titulo', 'Cadastro de produto')
@section('conteudo')

    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16 border-solid border-2 border-indigo-600 rounded">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Adicionando um novo produto</h2>
  
        <form action="{{ route('produto.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="dark:text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produto</label>
                    <input type="text" name="nome" id="nome"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Nome do produto" required="">
                </div>
                <div class="w-full">
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marca</label>
                    <input type="text" name="marca" id="marca"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Apple" required="">
                </div>
                <div class="w-full">
                    <label for="valor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor</label>
                    <input type="text" name="valor" id="valor"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="R$2999" required="">
                </div>
                <div>
                    <label for="categoria"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria</label>
                    <select id="categoria"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="categoria_id">
                        <option selected="">Seleciona categoria</option>
                        @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="codigo"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código</label>
                    <input type="number" name="codigo" id="codigo"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="12" required="">
                </div>
                <div class="sm:col-span-2">
                    <label for="descricao"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                    <textarea id="descricao" rows="8"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Escreva sua descrição aqui" name="descricao"></textarea>
                </div>
            </div>

            <input type="file" name="imagem" />

            <button type="submit" class="my-8 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Adicionar Produto</button>

        </form>
    </div>
    </section>



@endsection
