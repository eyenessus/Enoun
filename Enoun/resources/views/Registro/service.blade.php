@extends('layouts.main')
@section('titulo','Registro de Noticias')
@section('conteudo')

<div class="container">
<h1>Registro de serviços</h1>
<form method="POST" action="{{route('saveservice')}}" enctype="multipart/form-data">
@csrf
    <div class="mb-3">
  <label for="nome" class="form-label">Titulo do serviço</label>
  <input type="text" class="form-control" id="nome" name="nome" placeholder="Titulo" required>
</div>
<div class="mb-3">
  <label for="imagem" class="form-label">Imagem:</label>
  <input type="file" class="form-control" id="imagem" name="imagem" required>
</div>
<div class="mb-3">
  <label for="categoria" class="form-label">Categoria</label>
  <select class="form-select" name="categoria">  
  <option value="informatica">Informática</option>
  <option value="developeweb">Desenvolvimento web</option>
  <option value="developeApp">Desenvovilmento Mobile</option>
  <option value="system">Sistema operacionais</option>
</select>
</div>
<div class="mb-3">
  <label for="codigo" class="form-label">Codigo</label>
  <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código do serviço" required>
</div>
<div class="mb-3">
  <label for="descricao" class="form-label">Descrição:</label>
  <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
</div>

<div class="mb-3 form-check">
  <input type="checkbox" class="form-check-input" id="atendimento" value="atende" name="inforextra[]" >
  <label class="form-check-label" for="atendimento">Atendimento prioritário</label>
</div>

<div class="mb-3 form-check">
  <input type="checkbox" class="form-check-input" id="destaque" name="inforextra[]" value="destaque">
  <label class="form-check-label" for="destaque">Em destaque</label>
</div>


<div class="mb-3 form-check">
  <input type="checkbox" class="form-check-input" id="novo" value="novo" name="inforextra[]" >
  <label class="form-check-label" for="novo">Novo</label>
</div>

<div class="mb-3 form-check">
  <input type="checkbox" class="form-check-input" id="gratuito" name="inforextra[]" value="free" >
  <label class="form-check-label" for="gratuito">Gratuito</label>
</div>

<div class="mb-3 form-check">
  <input type="checkbox" class="form-check-input" id="pagamento" name="inforextra[]" value="pay">
  <label class="form-check-label" for="pagamento">Pagamento</label>
</div>

<div class="mb-3">

 <button class="btn btn-success">Registrar</button>
</div>
</form>
</div>
@endsection




