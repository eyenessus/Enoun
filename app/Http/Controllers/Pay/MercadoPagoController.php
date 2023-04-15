<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use App\Http\Requests\MercadoPagoRequest;
use App\Services\Pay\MercadoPagoService;
use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    public function __construct(protected MercadoPagoService $service)
    {
    }
    public function index()
    {
       
        return view('Pay.MercadoPago.mercadoPago');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }

    public function teste(MercadoPagoRequest $request)
    {

        switch ($request->pay) {

            case "mercadoPago":
                dd("Mercado Pago");
                break;

            case "mercadoPagoBoleto":
                dd('boleto');
                break;

            case "mercadoPagoPix":
                dd('px');
                break;

            case "mercadoPagoCredit":
                dd('credt');
                break;
            default:
                return redirect()->route('inicio');
        }
    }
}
