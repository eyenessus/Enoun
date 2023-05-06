@extends('Layout.Pay.MercadoPago.cartaoFormPagamento')
@section('titulo', 'Pagamento Mercado Pago')
@section('conteudo')
<script src="https://sdk.mercadopago.com/js/v2"></script>

<div class="container mx-auto max-w-screen-xl">

  <form id="form-checkout" action="{{ route('mercadoPago.credito.store') }}" method="POST"
    class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
    @csrf
    <div id="form-checkout__cardNumber"></div>
    <div id="form-checkout__expirationDate"></div>
    <div id="form-checkout__securityCode" ></div>
    <input type="text" id="form-checkout__cardholderName" placeholder="Titular do cartão" value=""
      class="w-full p-2 border border-gray-400 rounded-md" />
    <select id="form-checkout__issuer" name="issuer" class="w-full p-2 border border-gray-400 rounded-md">
      <option value="" disabled selected>Banco emissor</option>
    </select>
    <select id="form-checkout__installments" name="installments" class="w-full p-2 border border-gray-400 rounded-md">
      <option value="" disabled selected>Parcelas</option>
    </select>
    <select id="form-checkout__identificationType" name="identificationType"
      class="w-full p-2 border border-gray-400 rounded-md">
      <option value="" disabled selected>Tipo de documento</option>
    </select>
    <input type="text" id="form-checkout__identificationNumber" name="identificationNumber"
      placeholder="Número do documento" class="w-full p-2 border border-gray-400 rounded-md" />
    <input type="email" id="form-checkout__email" name="email" placeholder="E-mail" value=""
      class="w-full p-2 border border-gray-400 rounded-md" />

    <input id="token" name="token" type="hidden">
    <input id="paymentMethodId" name="paymentMethodId" type="hidden">
    <input id="transactionAmount" name="transactionAmount" type="hidden" value="{{ $total['total'] }}">
    <input id="description" name="description" type="hidden" value="Nome do Produto">

    <button type="submit" id="form-checkout__submit"
      class="col-span-full md:col-start-2 lg:col-start-3 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Pagar</button>
  </form>

</div>

@endsection