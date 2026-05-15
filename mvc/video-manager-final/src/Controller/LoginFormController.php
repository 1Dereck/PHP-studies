<?php

namespace Src\Controller;

use Nyholm\Psr7\Response;
use Src\Controller\Controller;
use Src\Helper\HtmlRenderarTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginFormController implements Controller
{
    use HtmlRenderarTrait;

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true) {
            return new Response(302, ['Location' => '/']);
        }
        return new Response(200,[], $this->renderTemplate('login-form'));
    }
}
