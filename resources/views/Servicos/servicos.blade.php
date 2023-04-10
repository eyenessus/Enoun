@extends('Layout.main')
@section('titulo', 'Serviços')
@section('conteudo')


    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-md">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Solucione suas demandas
                    tecnológicas com nossos serviços completos em informática e suporte remoto!</h2>
                <p class="mb-8 font-light text-gray-500 sm:text-xl dark:text-gray-400">Tenha soluções completas em serviços
                    de informática, desde impressões até suporte remoto via TeamViewer, tudo isso com expertise em sistemas
                    operacionais Windows e Linux para atender todas as suas necessidades tecnológicas.</p>

            </div>
        </div>
    </section>

    
    <div>
        <div class="container  px-5 p-5 dark:bg-slate-900 mx-auto ">
            <div class="container px-5 p-5 dark:bg-slate-900 rounded ">
                <h1 class="text-3xl text-bold dark:text-white">Grafica</h1>
                <div class="grid grid-cols-1 md:grid-cols-5 xl:grid-cols-4 sm:grid-cols-2 gap-5 pt-5 rounded  ">
                    @foreach ($servico as $servicos)
                    @if ($servicos->categoria->nome == 'internet')

                            <div>
                                <div
                                    class="w-full max-w-sm bg-white border border-gray-200  shadow dark:bg-slate-600 dark:border-gray-700 rounded">
                                    <a href="#">
                                        <img class="p-3 rounded-t-lg" src="/storage/{{ $servicos->imagem }}"
                                            alt="{{ $servicos->imagem }}" />
                                    </a>
                                  
                                    <div class="px-5 pb-5 mb-5">
                                        <a href="#">
                                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                             </h5>
                                        </a>

                                        <div class="flex items-center justify-between pt-5">
                                            <span
                                                class="text-3xl font-bold text-gray-900 dark:text-white">R${{ $servicos->valor }},00</span>

                                        </div>
                                        <div class="flex items-center justify-between pt-5">
                                            <div class="ml-auto">
                                                <a href="" class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">Comprar</a>
                                            </div>
                                            
                                        </div>

                                    </div>

                                </div>
                            </div>
                 
                            @endif
                            @endforeach

                </div>


                <h1 class="text-3xl text-bold dark:text-white mt-12">Computadores</h1>
                <div class="grid grid-cols-1 md:grid-cols-5 sm:grid-cols-2 gap-5 pt-5 xl:grid-cols-4">
                    @foreach ($servico as $servicos)
                    @if ($servicos->categoria->nome == 'informática')
                  
                            <div>
                                <div
                                    class="w-full max-w-sm bg-white border border-gray-200  shadow dark:bg-slate-600 dark:border-gray-700 rounded">
                                    <a href="#">
                                        <img class="p-3 rounded-t-lg" src="/storage/{{ $servicos->imagem }}"
                                            alt="{{ $servicos->imagem }}" />
                                    </a>
                                    <div class="px-5 pb-5 mb-5">
                                        <a href="#">
                                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                                </h5>
                                        </a>

                                        <div class="flex items-center justify-between pt-5">
                                            <span
                                                class="text-3xl font-bold text-gray-900 dark:text-white">R${{ $servicos->valor }},00</span>

                                        </div>
                                        <div class="flex items-center justify-between pt-5">
                                            <div class="ml-auto">
                                                <a href="" class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">Comprar</a>
                                            </div>
                                            
                                        </div>

                                    </div>

                                </div>
                            </div>
                    
                            @endif
                            @endforeach

                </div>

            </div>
        </div>

    </div>


@endsection
