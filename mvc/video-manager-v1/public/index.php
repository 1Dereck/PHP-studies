<?php

use Src\Controller\Controller;
use Src\Controller\Error404Controller;
use Src\Database\Conexao;
use Src\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$pdo = Conexao::getConexao();
$videoRepository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    $controller = new $controllerClass($videoRepository);
} else {
    $controller = new Error404Controller();
}
/** @var Controller $controller */

$controller->processaRequisicao();
