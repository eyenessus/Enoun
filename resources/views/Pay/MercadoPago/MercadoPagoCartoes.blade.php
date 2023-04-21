@extends('Layout.main')
@section('titulo', 'Meus cartões')
@section('conteudo')




    @if($cartoes)
    <h2 class="text-4xl font-extrabold dark:text-white mx-8 max-w-screen-xl">Meus cartões</h2>
<div class="grid grid-cols-1 sm:grid-cols-4 gap-4 container mx-auto my-8 max-w-screen-xl">
@foreach($cartoes as $cartao )
    <div class="p-6 bg-sky-300 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 max-w-screen-xl">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Cartão {{ $cartao->payment_method->name }}</h5>
        <img class="float-right" src="{{ $cartao->payment_method->secure_thumbnail }}">
        <div class="my-2">
            <p class="font-normal text-gray-700 dark:text-gray-400">Nome: <span class="font-bold">{{ $cartao->cardholder->name }}</span></p>
        </div>
        <div>
            <p class="font-normal text-gray-700 dark:text-gray-400">Primeiros digitos: <span class="font-bold">{{ $cartao->first_six_digits }}</span></p>
        </div>
        <div>
            <p class="font-normal text-gray-700 dark:text-gray-400">Últimos digitos: <span class="font-bold">{{ $cartao->last_four_digits }}</span></p>
        </div>
        <div class="my-2">
            <form action="{{ route('editarCartao',$cartao->id) }}" method="POST">
                @csrf
                <button type="submit" class="float-left text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">Editar</button>
            </form>
        </div>
        <div class="my-2">
            <form action="{{ route('apagarCartao',$cartao->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="float-right text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Deletar</button>
               
            </form>
        </div>
       
       
    </div>



@endforeach
@else
<div class="container mx-auto max-w-screen-xl">
    <h1 class="text-5xl font-extrabold dark:text-white">Sem cartões<small class="ml-2 font-semibold text-gray-500 dark:text-gray-400">no momento</small></h1>
</div>
@endif
</div>
@endsection