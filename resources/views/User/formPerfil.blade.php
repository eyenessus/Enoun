@extends('Layout.main')
@section('titulo','Meu Perfil e Configurações')
@section('conteudo')

<div class="container  px-5 mx-auto max-w-screen-xl">


    <form method="POST" action="{{ route('atualizarPerfil',$usuario->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <figure class="max-w-lg">
            <img class="max-w-full rounded-lg w-30 h-20" src="/storage/{{ $usuario->imagemPerfil }}" alt="{{ $usuario->nome }}">
        </figure>
        <div class="mb-6">
            <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seu nome</label>
            <input type="text" id="nome" name="nome"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Fulando" required value="{{ $usuario->nome }}">
        </div>
        <div class="mb-6">
            <label for="sobrenome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seu sobrenome</label>
            <input type="text" id="sobrenome" name="sobrenome"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Sobrenome S." required value="{{ $usuario->sobrenome }}">
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seu email</label>
            <input type="email" id="email" name="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="nome@enoun.com" required value="{{  $usuario->email }}">
        </div>
        <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alteração de
                senha</label>
            <input type="password" id="password" name="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Atualização de
            imagem de perfil</label>
        <input
            class="my-8 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="file_input" type="file" name="imagemPerfil">

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atualizar</button>
    </form>

</div>




@endsection