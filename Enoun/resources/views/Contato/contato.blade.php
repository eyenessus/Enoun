@extends('layouts.main')
@section('title','Contato')
@section('conteudo')
<h1>Contato</h1>
<div class="container">
<form action="" method="POST" name="cadastro" class="card">


<label for="user">Usuário :</label>
<input type="text" name="user" id="user">

<label for="texto">Texto</label>
<textarea name="texto" id="texto" cols="30" rows="10"></textarea>

<button class="btn btn-info" type="submit" name="cadastro" value="Cadastro" >Enviar</button>

</form>

@endsection