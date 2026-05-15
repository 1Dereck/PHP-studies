<?php

namespace Src\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Src\Controller\Controller;
use Src\Helper\FlashMessageTrait;
use Src\Repository\VideoRepository;
use Psr\Http\Message\ResponseInterface;

class DeleteVideoController implements Controller
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        // $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
        
        if ($id === null || $id === false) {
            $this->addErrorMessage('ID inválido');
            return new Response(302, ['Location' => '/']);
        }

        $success = $this->videoRepository->remove($id);
        if ($success === false) {
            $this->addErrorMessage('Erro ao remover vídeo');
            return new Response(302, ['Location' => '/']);
        } else {
            return new Response(302, ['Location' => '/']);
        }

    }
}
