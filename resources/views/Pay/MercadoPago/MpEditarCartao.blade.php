@extends('Layout.Pay.MercadoPago.cartaoFormPagamento')
@section('titulo', 'Salvar novo cartão')
@section('conteudo')
    <script src="https://sdk.mercadopago.com/js/v2"></script>

<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Editar cartão - Mercado Pago</h2>
        <form action="{{ route('atualizarCard',$dados->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do cartão</label>
                    <input type="text" name="cartaoHolder" id="cartaoHolder" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nome do cartão" required="" value="{{ $dados->cardholder->name }}">
                </div>
                <div class="w-full">
                    <label for="cardNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número do cartão de crédito</label>
                    <input type="number" name="cardNumber" id="cardNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Número do cartão de crédito" required="">
                </div>
                <div class="w-full">
                    <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código de segurança</label>
                    <input type="number" name="codigo" id="codigo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Código de segurança" required="" >
                </div>
                <div>
                    <label for="mesValidade" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mês de validade</label>
                    <select id="mesValidade" name="mesValidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="" value="{{ $dados->expiration_month }}">{{ $dados->expiration_month }}</option>
                        <option value="01">Janeiro</option>
                        <option value="02">Fevereiro</option>
                        <option value="03">Março</option>
                        <option value="04">Abril</option>
                        <option value="05">Maio</option>
                        <option value="06">Junho</option>
                        <option value="07">Julho</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </div>
                <div>
                    <label for="anoValidade" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ano de validade</label>
                    <input type="text" name="anoValidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ano de validade" required="" value="{{ $dados->expiration_year }}">
                </div>
                <div>
                    <label for="tipoDocumento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de documento</label>
                    <select id="tipoDocumento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="tipoDocumento">
                        <option selected="CPF" value="CPF">CPF</option>
                        <option value="CNPJ">CNPJ</option>
                    </select>
                </div>
                <div class="w-full">
                    <label for="documento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Documento</label>
                    <input type="number" name="documento" id="documento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Número do documento" required="" >
                </div>
            </div>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-black bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
               Editar cartão
            </button>
        </form>
    </div>
  </section>
@endsection