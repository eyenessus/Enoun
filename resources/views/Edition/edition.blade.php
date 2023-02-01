@extends('layouts.main')
@section('titulo','Editor de Serviços')
@section('conteudo')

<div class="container">
      
    <form method="POST" action="/editar/update/{{$servico->id}}" enctype="multipart/form-data" class="bg-light p-5 rounded shadow m-5">
      <h1>Edição de serviço</h1>
      @csrf
      @method('PUT')
        <div class="mb-3">
      <label for="nome" class="form-label">Titulo do serviço</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Titulo"  required value="{{$servico->nome}}">
    </div>
    <div class="mb-3">
      <label for="imagem" class="form-label">Imagem:</label>
      <input type="file" class="form-control" id="imagem" name="imagem" required>
      <div class="card" style="width: 18rem;">
        <img src="/img/publicserivces/{{$servico->imagem}}" class="card-img-top" alt="...">
        
      </div>
     
    </div>
    <div class="mb-3">
      <label for="categoria" class="form-label">Categoria</label>
      <select class="form-select" name="categoria" value="{{$servico->categoria}}">  
      <option value="informatica">Informática</option>
      <option value="developeweb">Desenvolvimento web</option>
      <option value="developeApp">Desenvovilmento Mobile</option>
      <option value="system">Sistema operacionais</option>
    </select>
    </div>
    <div class="mb-3">
      <label for="codigo" class="form-label">Codigo</label>
      <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código do serviço" required value="{{$servico->codigo}}">
    </div>
    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição:</label>
      <textarea class="form-control" id="descricao" name="descricao" rows="3" required placeholder="{{$servico->descricao}}" ></textarea>
    </div>
    
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="atendimento" value="Atendimento Prioritário" name="inforextra[]" >
      <label class="form-check-label" for="atendimento">Atendimento prioritário</label>
    </div>
    
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="destaque" name="inforextra[]" value="Em destaque">
      <label class="form-check-label" for="destaque">Em destaque</label>
    </div>
    
    
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="remoto" value="remoto" name="inforextra[]" >
      <label class="form-check-label" for="remoto">Novo</label>
    </div>
    
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="gratuito" name="inforextra[]" value="Gratuito" >
      <label class="form-check-label" for="gratuito">Gratuito</label>
    </div>
    
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="pagamento" name="inforextra[]" value="Pagamento">
      <label class="form-check-label" for="pagamento">Pagamento</label>
    </div>
    
    <div class="mb-3">
    
     <button class="btn btn-success">Registrar</button>
    </div>
    </form>
    </div>

@endsection