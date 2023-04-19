<form method="POST" action="{{ route('planoDeAssinaturaMP') }}">
    @csrf

    <div>
        <label for="reason">Motivo:</label>
        <input type="text" name="reason" id="reason" required>
    </div>

    <div>
        <label for="frequency">Frequência:</label>
        <input type="number" name="frequency" id="frequency" required>
    </div>

    <div>
        <label for="frequency_type">Tipo de frequência:</label>
        <select name="frequency_type" id="frequency_type" required>
            <option value="months">Meses</option>
            <option value="days">Dias</option>
        </select>
    </div>

    <div>
        <label for="billing_day">Dia de cobrança:</label>
        <input type="number" name="billing_day" id="billing_day" required>
    </div>

    <div>
        <label for="billing_day_proportional">Cobrança proporcional:</label>
        <select name="billing_day_proportional" id="billing_day_proportional" required>
            <option value="true">Sim</option>
            <option value="false">Não</option>
        </select>
    </div>

    <div>
        <label for="free_trial_frequency">Frequência do período de teste:</label>
        <input type="number" name="free_trial_frequency" id="free_trial_frequency">
    </div>

    <div>
        <label for="free_trial_frequency_type">Tipo de frequência do período de teste:</label>
        <select name="free_trial_frequency_type" id="free_trial_frequency_type">
            <option value="months">Meses</option>
            <option value="days">Dias</option>
        </select>
    </div>

    <div>
        <label for="transaction_amount">Valor da transação:</label>
        <input type="number" name="transaction_amount" id="transaction_amount" required>
    </div>

    <button type="submit">Enviar</button>
</form>
