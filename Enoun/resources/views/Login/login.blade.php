@extends('layouts.main')
@section('title','Login')
@section('conteudo')
<h1>Login</h1>
<div class="container">
<form action="" method="POST" name="login" class="card">

<label for="user">Usuário :</label>
<input type="text" name="user" id="user">

<label for="password">Senha :</label>
<input type="password" name="senha" id="senha">

<button class="btn btn-info" type="submit" name="login" value="Login" >Entrar</button>

</form>

</div>
@endsection