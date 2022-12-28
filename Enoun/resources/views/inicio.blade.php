<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enoun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg border-bottom border-2 border-primary sticky-md-top"
        style="background-color: #00c8ff;">
        <div class="container-fluid ">
            <a class="navbar-brand text-dark text-uppercase " href="#">
                <img src="/logo.png" alt="" height="30">
            </a>
            <button class="navbar-toggler border-top border border-info bg-light" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon border-info"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-light text-uppercase" aria-current="page" href="#">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light text-uppercase" href="#">Serviços</a>
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
                    <li><a class="dropdown-item" href="#">Serviços digitais</a></li>
                    <li><a class="dropdown-item" href="#">Revelações de fotos</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <h6 class="dropdown-header text-dark text-uppercase">Softwares</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Windows 11 Pro</a></li>
                    <li><a class="dropdown-item" href="#">Desenvolvimento de softwares</a></li>
                    
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <h6 class="dropdown-header text-dark text-uppercase">Acessórios</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Monitores</a></li>
                    <li><a class="dropdown-item" href="#">Roteador Wireless</a></li>
                </ul>
            </li>
            <li>
                <a href="" class="nav-link text-light text-uppercase">Contato</a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Pesquisa" aria-label="Search">
            <button class="btn btn-outline-info bg-info text-info border bg-light border-2 border-info"
            type="submit">Buscar</button>
        </form>
        <a href="">
            <button
            class="btn btn-primary text-center text-light float-end mt-5 mt-md-0 mt-md-0 m-2 m-md-1 m-lg-1">Login</button>
        </a>
        
        <a href="">
            <button class="btn btn-primary text-center d-flex float-start mt-5 mt-md-0">Cadastra-se</button>
        </a>
    </div>
</div>
</nav>
</header>

<main>
    
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/img/inicio/desenvolvimento.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Desenvolvimento de alto nível</h5>
                    <p>Os melhores softwares já desenvolvido.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/inicio/atendimento.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Atendimento especializado</h5>
                    <p>Seja aqui conosco ou a distância, nosso foco está em resolver sua solução!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/img/inicio/robo.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Serviços remotos</h5>
                    <p>Preparamos com muita práticidade, serviços remotos que você solicita em poucos toques!</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
    data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próxima</span>
</button>
</div>



<h1 class="text-center col-auto m-lg-5 m-3 text-info  container-fluid text-uppercase w-5 w-md-0">A conexão
    começa aqui!</h1>
    
    
    <div class="container">
        <div class="row row-cols-2 row-cols-md-6 g-4 mb-3">
            
            <div class="col">
                <div class="card h-100">
                    <img src="/img/icons/Ativo 6.png" class="card-img-top p-md-5 p-3" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Suporte Remoto</h5>
                        <p class="card-text">Time preparado para atender você á distancia de forma produtiva e
                            prática.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col">
                    <div class="card h-100">
                        <img src="/img/icons/Ativo 7.png" class="card-img-top p-md-5 p-3" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Conversas em tempo real</h5>
                            <p class="card-text">Conversas em tempo real com os especialista, para sanar dúvidas e
                                solicita serviços.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="card h-100">
                            <img src="/img/icons/Ativo 4.png" class="card-img-top p-md-5 p-3" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Assistência Técnica</h5>
                                <p class="card-text">Você decide, quando, e quantos serviços precisa, a gente soluciona.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="card h-100">
                            <img src="/img/icons/Ativo 8.png" class="card-img-top p-md-5 p-3" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Proteção contra vírus</h5>
                                <p class="card-text">Ajudamos a proteger você ou até mesmo sua empresa</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="card h-100">
                            <img src="/img/icons/Ativo 9.png" class="card-img-top p-md-5 p-4" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Localização</h5>
                                <p class="card-text">Para qualquer hora, temos a localização especifica do seu dispostivo
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="card h-100">
                            <img src="/img/icons/Ativo 10.png" class="card-img-top p-md-5 p-4" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Integridade</h5>
                                <p class="card-text">Garantimos precisão, proteção e integridade com suas informações</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container m-md-5 mb-3">
                    <h1>Informações do dia</h1>
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    
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