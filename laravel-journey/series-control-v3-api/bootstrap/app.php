<?php

use App\Http\Middleware\Autenticador;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'autenticador' => Autenticador::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Garante que rotas api/* sempre retornam JSON em caso de erro
        $exceptions->shouldRenderJsonWhen(function ($request, $e) {
            return $request->is('api/*');
        });
    })
    ->booted(function () {
        // Garante que auth:sanctum nunca grave /api/* como url.intended na sessão
        Authenticate::redirectUsing(function ($request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return null; // retorna null = sem redirect, força resposta JSON
            }
            return route('login');
        });
    })->create();
