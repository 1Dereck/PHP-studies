<?php

namespace Src\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Controller\Controller;
use Src\Helper\HtmlRenderarTrait;
use Src\Models\Video;
use Src\Repository\VideoRepository;

class VideoFormController implements Controller
{
    use HtmlRenderarTrait;

    public function __construct(private VideoRepository $repository)
    {
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
        /** @var ?Video $video */
        $video = null;
        if ($id !== false && $id !== null) {
            $video = $this->repository->find($id);
        }

        return new Response(200, [], $this->renderTemplate('video-form', ['video' => $video]));
    }
}
