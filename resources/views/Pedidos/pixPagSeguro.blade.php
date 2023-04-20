@extends('Layout.main')
@section('titulo', 'Pedidos')
@section('conteudo')


<section class="bg-white dark:bg-gray-900 container mx-auto">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16 container">
        <h2 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">PIX PAG-SEGURO</h2>
        <p class="mb-4 text-xl font-extrabold leading-none text-gray-900 md:text-2xl dark:text-white">R$ {{number_format($pix['total'], 2, ',', '.')}}
           </p>
        <div class="max-w-screen-xl mx-auto my-8">
            <div class="mx-8 MY-8">
             <img src="{{$pix['qrCode'] }}" class="w-96" alt="PIX">
             
            </div>
            <div class="my-8 mx-8">
                <textarea name="codigo" cols="38" rows="10">{{ $pix['textoCopiaEcola'] }}</textarea>
            </div>
         </div>
  </section>

@endsection