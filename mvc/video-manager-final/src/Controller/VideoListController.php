<?php

namespace Src\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Controller\Controller;
use Src\Helper\HtmlRenderarTrait;
use Src\Repository\VideoRepository;

class VideoListController implements Controller
{
    use HtmlRenderarTrait;
    
    public function __construct(private VideoRepository $videoRepository)
    {

    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $videoList = $this->videoRepository->all();
        return new Response(200, [], $this->renderTemplate('video-list', ['videoList' => $videoList]));
    }
}
