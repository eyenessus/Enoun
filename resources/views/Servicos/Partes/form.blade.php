@csrf()
<x-alert />
<div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
    <div class="sm:col-span-2">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Serviço</label>
        <input type="text" name="nome" id="nome"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Nome do Serviço" required="" value="{{ $servico['nome'] ?? old('nome') }}">
    </div>

    <div class="w-full">
        <label for="valor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor</label>
        <input type="text" name="valor" id="valor"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="R$2999" required="" value="{{ $servico['valor'] ?? old('valor')}}">
    </div>
    <div>
        <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria</label>
        <select id="categoria"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            name="categoria_id">
            <option selected="">Seleciona categoria</option>
            @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código</label>
        <input type="number" name="codigo" id="codigo"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="12" required="" value="{{ $servico['codigo'] ?? old('codigo') }}">
    </div>
    <div class="sm:col-span-2">
        <label for="descricao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
        <textarea id="descricao" rows="8"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Escreva sua descrição aqui" name="descricao">{{ $servico['descricao'] ?? old('descricao')}}</textarea>
    </div>
</div>

<input type="file" name="imagem" />