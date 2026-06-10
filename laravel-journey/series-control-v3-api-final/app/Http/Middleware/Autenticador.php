<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guest()) {
            // Se a requisição vier do Postman (API), retorna JSON
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }

            // Se vier do navegador, redireciona para login
            // Usa redirect()->to() em vez de guest() para NÃO gravar url.intended
            // (evita que URLs de /api/* sejam salvas como destino pós-login)
            return redirect()->to(route('login'));
        }

        return $next($request);
    }
}

