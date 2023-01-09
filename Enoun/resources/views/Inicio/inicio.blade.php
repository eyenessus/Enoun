@extends('layouts.main')
@section('titulo','Inicio')
@section('conteudo')

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner h-75">
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
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
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
                        <img src="/img/icons/Ativo 7.png" class="card-img-top p-md-5 p-3 " alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Conversas em tempo real</h5>
                            <p class="card-text">Conversas em tempo real com os especialista, para sanar dúvidas e
                                solicita serviços.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="card h-100">
                            <img src="/img/icons/Ativo 4.png" class="card-img-top p-md-5 p-3 " alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Assistência Técnica</h5>
                                <p class="card-text">Você decide, quando, e quantos serviços precisa, a gente soluciona.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="card h-100">
                            <img src="/img/icons/Ativo 8.png" class="card-img-top p-md-5 p-3 " alt="...">
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
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <h1>Notícias</h1>
                            @if(count($inicio) > 0 )
                            @foreach($inicio as $value)
                            
                            <div class="card border-0">
                                <img src="/img/publicnoticias/{{$value->imagem}}" class=" w-70 rounded" alt="..." id="imagemnote">
                                <div class="card-body">
                                    <h5 class="card-title mt-3">{{ $value->titulo}}</h5>
                                    <p class="card-text">{{ $value->descricao}}</p>
                                    <p class="card-text"><small class="text-muted">{{date('d/m/Y', strtotime($value->updated_at))}}</small></p>
                                    <a href="/resultadoNoticias/{{$value->id}}" class="btn btn-primary">Saiba mais</a>
                                    
                                </div>
                            </div>
                            
                            
                            @endforeach
                            @else
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                @endif
                                
                            </div> 
                            <div class="col">
                                <h1>Destaques</h1>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title mt-3">Informações</div>
                                        <div class="btn btn-info text-capitalize text-light">Clique aqui</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                        
                    </div>
                    @endsection