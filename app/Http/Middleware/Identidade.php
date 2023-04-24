<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Identidade
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && !Auth()->user()->identidade)
        {
            return redirect()->route('identidade');
        }else if(Auth::check() && !Auth()->user()->endereco){
            dd(Auth()->user()->endereco);
            return redirect()->route('endereco');
        }
        return $next($request);
    }
}
