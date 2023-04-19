<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/assinatura/mp',
        '/planoDeAssinatura/mp',
        '/notifications/mp',
        '/cliente/mp',
        '/planos/mp',
        '/gerenciar/todos/assinaturas'
    ];
}
