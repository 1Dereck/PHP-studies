<?php

namespace Src\Controller;

use Src\Models\Video;
use Src\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class JsonVideoListController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $videoList = array_map(function (Video $video): array {
            return [
                'url' => $video->getUrl(),
                'title' => $video->getTitulo(),
                'file_path' => $video->getFilePath() === null ? null : '/img/uploads/' . $video->getFilePath(),
            ];
        }, $this->videoRepository->all());

        return new Response(200, [
            'Content-Type' => 'application/json'
        ], json_encode($videoList));
    }
}
