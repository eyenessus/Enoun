@extends('Layout.main')
@section('titulo', 'Produtos')
@section('conteudo')

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Seja surpreendido pela inovação tecnológica!</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Explore o
                    melhor do mundo da tecnologia e encontre os produtos eletrônicos mais incríveis aqui, onde cada click é
                    uma descoberta surpreendente!</p>


            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="https://www.atacadogames.com/imagem/apple/celular-apple-iphone-14-pro-max-a2651-512gb-5g-esim-tela-6-7%27%27-cameras-de-48mp-12mp-12mp-e-12mp-gold/2/149668.jpg?pfdrid_c=true" alt="mockup">
            </div>
        </div>
    </section>

    <div>
        <div class="container  px-5 p-5 dark:bg-slate-900 ">
        <div class="container px-5 p-5 dark:bg-slate-900 rounded ">
            <h1 class="text-3xl text-bold dark:text-white">Roteadores</h1>
            <div class="grid grid-cols-1 md:grid-cols-5 sm:grid-cols-2 gap-5 pt-5 rounded">
             
                @foreach($produto as $produtos)
              
                <div>
                    <div
                        class="w-full max-w-sm bg-white border border-gray-200  shadow dark:bg-slate-600 dark:border-gray-700 rounded">
                        <a href="#">
                            <img class="p-3 rounded-t-lg"
                                src="/storage/{{ $produtos->imagem }}" alt="product image" />
                        </a>
                        <div class="px-5 pb-5 mb-5">
                            <a href="#">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Apple Watch
                                    Series 7 GPS, Aluminium Case, Starlight Sport</h5>
                            </a>

                            <div class="flex items-center justify-between pt-5">
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">R${{ $produtos->valor }}</span>
                                <a href="#"
                                    class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

             

                <div>09</div>

                <div>01</div>

                <div>09</div>

                <div>01</div>

                <div>09</div>
                <div>09</div>

                <div>01</div>

                <div>09</div>

                <div>01</div>

                <div>09</div>

            </div>


            <h1 class="text-3xl text-bold dark:text-white">Computadores</h1>
            <div class="grid grid-cols-1 md:grid-cols-5 sm:grid-cols-2 gap-5 pt-5">

            @foreach($produto as $produtos)
              
                <div>
                    <div
                        class="w-full max-w-sm bg-white border border-gray-200  shadow dark:bg-slate-600 dark:border-gray-700 rounded">
                        <a href="#">
                            <img class="p-3 rounded-t-lg"
                                src="/storage/{{ $produtos->imagem }}" alt="product image" />
                        </a>
                        <div class="px-5 pb-5 mb-5">
                            <a href="#">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Apple Watch
                                    Series 7 GPS, Aluminium Case, Starlight Sport</h5>
                            </a>

                            <div class="flex items-center justify-between pt-5">
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">R${{ $produtos->valor }}</span>
                                <a href="#"
                                    class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

                <div>
                    <div
                        class="w-full max-w-sm bg-white border border-gray-200  shadow dark:bg-slate-600 dark:border-gray-700 rounded">
                        <a href="#">
                            <img class="p-3 rounded-t-lg round"
                                src="https://a-static.mlcdn.com.br/800x560/apple-iphone-13-pro-max-256gb-dourado-tela-67-12mp-ios/magazineluiza/233007400/a7227ff292e9a0309c824677aeaa2551.jpg" alt="product image" />
                        </a>
                        <div class="px-5 pb-5 mb-5">
                            <a href="#">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Apple Watch
                                    Series 7 GPS, Aluminium Case, Starlight Sport</h5>
                            </a>

                            <div class="flex items-center justify-between pt-5">
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">R$599</span>
                                <a href="#"
                                    class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div>09</div>

                <div>01</div>

                <div>09</div>

                <div>01</div>

                <div>09</div>

            </div>

        </div>
    </div>



@endsection
