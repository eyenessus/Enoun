<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('titulo')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg border-bottom border-2 border-primary sticky-md-top"
            style="background-color: #00c8ff;">
            <div class="container-fluid ">
                <a class="navbar-brand text-dark text-uppercase " href="{{route('inicio')}}">
                    <img src="/img/logoCentral/logo.png" alt="" height="30">
                </a>
                <button class="navbar-toggler border-top border border-info bg-light" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon border-info"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-light text-uppercase" aria-current="page" href="{{route('inicio')}}">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light text-uppercase" href="{{route('servicos')}}">Serviços</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light text-uppercase" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Categorias
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <h6 class="dropdown-header text-dark text-uppercase">Informática</h6>
                                </li>
                                <li><a class="dropdown-item" href="/service/#informatica">Serviços digitais</a></li>
                                <li><a class="dropdown-item" href="/service/#informatica">Revelações de fotos</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <h6 class="dropdown-header text-dark text-uppercase">Softwares</h6>
                                </li>
                                <li><a class="dropdown-item" href="/service/#system">Windows 11 Pro</a></li>
                                <li><a class="dropdown-item" href="/service/#system">Desenvolvimento de softwares</a></li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <h6 class="dropdown-header text-dark text-uppercase">Acessórios</h6>
                                </li>
                                <li><a class="dropdown-item" href="/service/#acess">Monitores</a></li>
                                <li><a class="dropdown-item" href="/service/#acess">Roteador Wireless</a></li>

                                <li>
                                    <h6 class="dropdown-header text-dark text-uppercase">Outras Opções</h6>
                                </li>
                                <li><a class="dropdown-item" href="{{route('RegistrarNoticia')}}">Registrar Notícias (Início)</a></li>
                                <li><a class="dropdown-item" href="{{route('RegistrarServico')}}">Registra Serviços</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('contato')}}" class="nav-link text-light text-uppercase">Contato</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" action="{{route('buscar')}}" >
                        <input class="form-control me-2" type="search" placeholder="Pesquisa" aria-label="Search" name="pesquisa">
                        <button class="btn btn-outline-info bg-info text-info border bg-light border-2 border-info"
                            type="submit">Buscar</button>
                    </form>
                    <a href="{{route('login')}}">
                        <button
                            class="btn btn-primary text-center text-light float-end mt-5 mt-md-0 mt-md-0 m-2 m-md-1 m-lg-1">Login</button>
                    </a>

                    <a href="{{route('cadastro')}}">
                        <button class="btn btn-primary text-center d-flex float-start mt-5 mt-md-0">Cadastra-se</button>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @if(session('mensagem'))
        <p>{{session('mensagem')}}</p>
        @endif
        @yield('conteudo')
    </main>


    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted border-top border-info">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between ">

            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>Enou Company
                        </h6>
                        <p>
                            Buscamos as melhores soluções para entrega com alta qualidade, no atendimento e nos serviços
                            para você.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Produtos
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Acessórios</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Eletrônicos</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Produtos digitais</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Cursos</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Fundadores
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Emerson S.</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contato</h6>
                        <p><i class="fas fa-home me-3"></i> Rua Andrea Sansovino 278</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            atendimento@enoun.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> +55 (11) 9 9251-5755</p>

                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2023 Copyright

        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>