<?php

namespace Src\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Controller\Controller;
use Src\Helper\FlashMessageTrait;
use Src\Models\Video;
use Src\Repository\VideoRepository;

class NewVideoController implements Controller
{
    use FlashMessageTrait;
    
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
    
        $url = filter_var($parsedBody['url'] ?? null, FILTER_VALIDATE_URL);
        if ($url === false || $url === null) {
            $this->addErrorMessage('URL inválida!');
            return new Response(302, ['Location' => '/novo-video']);
        }

        $titulo = filter_var($parsedBody['titulo'] ?? null);
        if ($titulo === false || $titulo === null) {
            $this->addErrorMessage('Titulo inválido!');
            return new Response(302, ['Location' => '/novo-video']);
        }

        $video = new Video($url, $titulo);
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $safeFileName = uniqid() . '_' . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['image']['tmp_name']);
            
            if (str_starts_with($mimeType, 'image/')) {
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ . '/../../public/img/uploads/' . $safeFileName
                );
                $video->setFilePath($safeFileName);
            }
        }

        $success = $this->videoRepository->add($video);
        if ($success === false) {
            $this->addErrorMessage('Erro ao adicionar video!');
            return new Response(302, ['Location' => '/novo-video'], '');
        } else {
            return new Response(302, ['Location' => '/'], '');
        }
    }
}
