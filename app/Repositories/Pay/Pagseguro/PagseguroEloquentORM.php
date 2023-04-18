<?php
namespace App\Repositories\Pay\Pagseguro;
use App\Models\Pedido;
use Illuminate\Http\Request;
class PagseguroEloquentORM implements PagseguroInterface
{
    public function __construct(protected Pedido $model){}
    public function receberNotificacoes(Request $request)
    {
        $token = env('PAGSEGURO_TOKEN');
        $payload = '{"id":"ORDE_2E9CF1B1-A470-4726-BF47-2B11364E3B09","reference_id":"ex-00001","created_at":"2023-04-18T11:09:23.098-03:00","customer":{"name":"Jose da Silva","email":"email@test.com","tax_id":"12345678909","phones":[{"type":"MOBILE","country":"55","area":"11","number":"999999999"}]},"items":[{"reference_id":"referencia do item","name":"nome do item","quantity":1,"unit_amount":500}],"shipping":{"address":{"street":"Avenida Brigadeiro Faria Lima","number":"1384","complement":"apto 12","locality":"Pinheiros","city":"São Paulo","region_code":"SP","country":"BRA","postal_code":"01452002"}},"notification_urls":["https://webhook.site/f5140fda-b70c-4caf-9ae8-bf61210412c1"],"links":[{"rel":"SELF","href":"https://sandbox.api.pagseguro.com/orders/ORDE_2E9CF1B1-A470-4726-BF47-2B11364E3B09","media":"application/json","type":"GET"},{"rel":"PAY","href":"https://sandbox.api.pagseguro.com/orders/ORDE_2E9CF1B1-A470-4726-BF47-2B11364E3B09/pay","media":"application/json","type":"POST"}],"charges":[{"id":"CHAR_F265DA02-FDFF-4760-9EDD-C7BF0AE89CA2","reference_id":"referencia da cobranca","status":"PAID","created_at":"2023-04-18T11:09:23.584-03:00","paid_at":"2023-04-18T11:09:24.000-03:00","description":"descricao da cobranca","amount":{"value":100000,"currency":"BRL","summary":{"total":100000,"paid":100000,"refunded":0}},"payment_response":{"code":"20000","message":"SUCESSO","reference":"032416400102"},"payment_method":{"type":"CREDIT_CARD","installments":1,"capture":true,"card":{"brand":"visa","first_digits":"453962","last_digits":"2097","exp_month":"12","exp_year":"2026","holder":{"name":"Emerson Sousa"}},"soft_descriptor":"sellervirtual"},"links":[{"rel":"SELF","href":"https://sandbox.api.pagseguro.com/charges/CHAR_F265DA02-FDFF-4760-9EDD-C7BF0AE89CA2","media":"application/json","type":"GET"},{"rel":"CHARGE.CANCEL","href":"https://sandbox.api.pagseguro.com/charges/CHAR_F265DA02-FDFF-4760-9EDD-C7BF0AE89CA2/cancel","media":"application/json","type":"POST"}],"metadata":{}}]}';

        $data = $token . '-' . $payload;
        $signature = hash('sha256', $data);
        if ($signature === '8af3fe72804407bd0ea73624ad300973eb3128ee3b89078b12e5286379960093') {
            dd('tryeee');
        }
    }
}