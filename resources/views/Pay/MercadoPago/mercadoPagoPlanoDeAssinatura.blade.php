@extends('Layout.Pay.MercadoPago.cartaoFormPagamento')
@section('titulo', 'Criação de plano de assinatura')
@section('conteudo')
<div class="max-w-screen-xl container mx-auto pb-5">
    <h2 class="text-4xl font-bold dark:text-white">Criação de plano de assinatura - Mercado Pago</h2>
    <form method="POST" action="{{ route('planoDeAssinaturaMP') }}" class="p-6 bg-white rounded-lg shadow-md ">
        @csrf
        <div>
            <div class="mb-4">
                <label for="reason" class="block mb-2 font-semibold">Nome do plano:</label>
                <input type="text" name="reason" id="reason" required
                    class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:ring-2 ring-indigo-200 ring-opacity-50">
            </div>

            <div class="mb-4">
                <label for="frequency" class="block mb-2 font-semibold">Frequência:</label>
                <input type="number" name="frequency" id="frequency" required
                    class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:ring-2 ring-indigo-200 ring-opacity-50">
            </div>

            <div class="mb-4">
                <label for="frequency_type" class="block mb-2 font-semibold">Tipo de frequência:</label>
                <select name="frequency_type" id="frequency_type" required
                    class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:ring-2 ring-indigo-200 ring-opacity-50">
                    <option value="months">Meses</option>
                    <option value="days">Dias</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="billing_day" class="block mb-2 font-semibold">Dia de cobrança:</label>
                <input type="number" name="billing_day" id="billing_day" required
                    class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:ring-2 ring-indigo-200 ring-opacity-50">
            </div>

            <div class="mb-4">
                <label for="billing_day_proportional" class="block mb-2 font-semibold">Cobrança proporcional:</label>
                <select name="billing_day_proportional" id="billing_day_proportional" required
                    class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:ring-2 ring-indigo-200 ring-opacity-50">
                    <option value="true">Sim</option>
                    <option value="false">Não</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="free_trial_frequency" class="block mb-2 font-semibold">Frequência do período de
                    teste:</label>
                <input type="number" name="free_trial_frequency" id="free_trial_frequency"
                    class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:ring-2 ring-indigo-200 ring-opacity-50">
            </div>

            <div class="mb-4">
                <label for="free_trial_frequency_type" class="block mb-2 font-semibold">Tipo de frequência do período de
                    teste:</label>
                <select name="free_trial_frequency_type" id="free_trial_frequency_type"
                    class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:ring-2 ring-indigo-200 ring-opacity-50">
                    <option value="months">Meses</option>
                    <option value="days">Dias</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="transaction_amount" class="block mb-2 font-semibold">Valor da transação:</label>
                <input type="number" name="transaction_amount" id="transaction_amount"
                    class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:ring-2 ring-indigo-200 ring-opacity-50"
                    required>
            </div>

            <button type="submit"
                class="float-right p-5 font-bold text-white bg-indigo-500 rounded-lg hover:bg-indigo-600 focus:outline-none focus:shadow-outline-indigo active:bg-indigo-600">Enviar</button>
        </div>

    </form>
</div>

@endsection