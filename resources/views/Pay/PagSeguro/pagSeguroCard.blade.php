@extends('Layout.Pay.PagSeguro.cartaoPagseguro')
@section('titulo', 'Pagamento PagSeguro')
@section('conteudo')
<script src="https://assets.pagseguro.com.br/checkout-sdk-js/rc/dist/browser/pagseguro.min.js"></script>
<form action="{{ route('pagamentoCartaoPag') }}" method="POST" id="meuFormulario">
    @csrf
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required><br>

    <label for="numero">Número do cartão:</label>
    <input type="text" id="numero" name="numero" pattern="[0-9]{16}" required><br>

    <label for="mes">Mês de expiração:</label>
    <input type="text" id="mes" name="mes" pattern="[0-9]{2}" required><br>

    <label for="ano">Ano de expiração:</label>
    <input type="text" id="ano" name="ano" pattern="[0-9]{4}" required><br>

    <label for="codigo">Código de segurança:</label>
    <input type="text" id="codigo" name="codigo" pattern="[0-9]{3}" required><br>
    <input type="hidden" value="" name="token" id="token">
    <input type="submit" value="Enviar" id="submit">
</form>
@endsection