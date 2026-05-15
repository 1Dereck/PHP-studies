<?php

namespace Src\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Src\Controller\Controller;
use Src\Helper\FlashMessageTrait;
use Src\Models\Video;
use Src\Repository\VideoRepository;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;

class EditVideoController implements Controller
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
        
        $parseBody = $request->getParsedBody();
        $url = filter_var($parseBody['url'] ?? null, FILTER_VALIDATE_URL);
        $titulo = filter_var($parseBody['titulo'] ?? null, FILTER_SANITIZE_SPECIAL_CHARS);

        $video = new Video($url, $titulo);
        $video->setId($id);

        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                __DIR__ . '/../../public/img/uploads/' . $_FILES['image']['name']
            );
            $video->setFilePath($_FILES['image']['name']);
        }

        $success = $this->videoRepository->update($video);

        if ($success === false) {
            $this->addErrorMessage('Erro ao remover vídeo');
            return new Response(302, ['Location' => '/']);
        }
        
        return new Response(302, ['Location' => '/']);
    }
}
