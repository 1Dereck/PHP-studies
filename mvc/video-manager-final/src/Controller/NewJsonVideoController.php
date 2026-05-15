<?php

namespace Src\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Src\Controller\Controller;
use Src\Models\Video;
use Src\Repository\VideoRepository;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;

class NewJsonVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository) 
    {

    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $videoData = json_decode($request->getBody()->getContents(), true);

        $video = new Video($videoData['url'], $videoData['titulo']);
        $this->videoRepository->add($video);

        return new Response(201);
    }
}