@extends('layouts.main')
@section('title','Cadastro')
@section('conteudo')
<h1>CADASTRO</h1>
<div class="container">
<form action="" method="POST" name="cadastro" class="card">


<label for="user">Usuário :</label>
<input type="text" name="user" id="user">

<label for="pnome">Nome :</label>
<input type="text" name="pnome" id="primeironome">

<label for="snome">Sobrenome :</label>
<input type="text" name="snome" id="sobrenome">

<label for="nascimento">Data de nascimento :</label>
<input type="date" name="nascimento" id="nascimento">

<label for="password">Senha :</label>
<input type="password" name="senha" id="senha">

<button class="btn btn-info" type="submit" name="cadastro" value="Cadastro" >Cadastrar</button>

</form>

</div>
@endsection