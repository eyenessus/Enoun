@extends('Layout.main')
@section('titulo', 'Cadastro de serviços')
@section('conteudo')
<div class="py-8 px-4 mx-auto max-w-2xl lg:py-16 border-solid border-2 border-indigo-600 rounded">
    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Adicionando um novo serviço</h2>
    <form action="{{ route('servico.store') }}" method="POST" enctype="multipart/form-data">
        @include('Servicos.Partes.form')
        <button type="submit"
            class="my-8 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Adicionar
            serviço</button>
    </form>
</div>
</section>
@endsection