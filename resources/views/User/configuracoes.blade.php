@extends('Layout.main')
@section('titulo','Meu Perfil e Configurações')
@section('conteudo')

<section class="bg-white dark:bg-gray-900">
    <div
        class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">

        <img class="mx-auto w-64 h-64 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
            src="{{  $meuPerfil->imagemPerfil }}" alt="Bordered avatar">


        <h2 class="text-4xl font-bold dark:text-white mx-auto my-8">{{ $meuPerfil->nome. ' ' .$meuPerfil->sobrenome}}
        </h2>
        <div class="container border rounded dark:text-green-400">
            <div class="my-8">
                <p class="text-lg text-center font-bold"> {{$meuPerfil->identidade->tipoDocumento}} </p>
                <p class="text-lg text-center"> {{$meuPerfil->identidade->documento}} </p>
                <p class="text-lg text-center"> {{$meuPerfil->identidade->codigo_area . ' ' .
                    $meuPerfil->identidade->telefone}} </p>
            </div>
            <div class="my-8">
                <p class="text-lg text-center font-bold"> {{$meuPerfil->endereco->rua .' ' .$meuPerfil->endereco->numero
                    }} </p>
                <p class="text-lg text-center"> {{$meuPerfil->endereco->cidade}} </p>
                <p class="text-lg text-center"> {{$meuPerfil->endereco->cep}} </p>
            </div>
        </div>
        <div class="mt-4 md:mt-0">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Let's create more
                tools and ideas that brings us together.</h2>
            <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">Flowbite helps you connect with
                friends and communities of people who share your interests. Connecting with your friends and family as
                well as discovering new ones is easy with features like Groups.</p>

        </div>
        <div>
         <div class="mx-auto">
             <div>
                <form action="{{ route('apagarPerfil',$meuPerfil->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                    class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">EDITAR</button>
                </form>
             </div>
           <div>
            <form action="{{ route('apagarPerfil',$meuPerfil->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">DELETAR
                    PERFIL</button>
            </form>
           </div>
            </div>
        </div>
    </div>

</section>

@endsection