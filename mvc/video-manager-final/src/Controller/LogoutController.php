<?php

namespace Src\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Controller\Controller;
use Nyholm\Psr7\Response;

class LogoutController implements Controller
{
    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        session_destroy();
        return new Response(302, ['Location' => '/login'], '');
    }
}
