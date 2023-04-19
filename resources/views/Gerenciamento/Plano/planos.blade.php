@extends('Layout.main')
@section('titulo', 'Todos planos')
@section('conteudo')
<div class="class container mx-auto">
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

                <h1 class="text-5xl font-extrabold dark:text-white">Planos</h1>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">ID</th>
                                <th scope="col" class="px-4 py-3">Nome</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Inscritos</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($planos as $plano)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"> {{
                                    $plano['id'] }}</th>
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{
                                    $plano['reason'] }}</th>
                                <td class="px-4 py-3"> {{ $plano['status'] }}</td>
                                <td class="px-4 py-3">{{ $plano['subscribed'] }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
     
            </div>
        </div>
    </section>
</div>


@endsection