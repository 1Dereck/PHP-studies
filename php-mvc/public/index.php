<?php

use Src\Controller\{ Controller, DeleteVideoController, EditVideoController, Error404Controller, NewVideoController, VideoFormController, VideoListController };
use Src\Database\Conexao;
use Src\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$pdo = Conexao::getConexao();
$videoRepository = new VideoRepository($pdo);

// Verifica se o site é localhost:8080/ e se for vazio 
// (sem /) leva para o mesmo listagem-videos.php
if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
    $controller = new VideoListController($videoRepository);
} 
// Primeiro filtra pela rota, depois pelo método. É como uma triagem
// em duas etapas: onde você quer ir e o que você quer fazer lá. 
elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new VideoFormController($videoRepository);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new NewVideoController($videoRepository);
    }
} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new VideoFormController($videoRepository);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new EditVideoController($videoRepository);
    }
} elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
    $controller = new DeleteVideoController($videoRepository);
} else {
    $controller = new Error404Controller();
}
/** @var Controller $controller */
$controller->processaRequisicao();
