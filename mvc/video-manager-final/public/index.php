<?php

use Src\Controller\Controller;
use Src\Controller\Error404Controller;
use Src\Database\Conexao;
use Src\Repository\VideoRepository;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

require_once __DIR__ . '/../vendor/autoload.php';

$pdo = Conexao::getConexao();
$videoRepository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../config/routes.php';

// ?? '' é uma forma de definir um valor padrão caso o valor da variável seja null
$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
// GET, POST, PUT, DELETE
$httpMethod = $_SERVER['REQUEST_METHOD'];

session_start();
session_regenerate_id();
$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute) {
    header('Location: /login');
    return;
}

// O | não tem nenhum significado especial, é apenas um caractere que será usado 
// para separar o método http do caminho, ou seja, ele está sendo usado aqui para concatenar variáveis
// poderia ser . ou _ ou qualquer outro caractere
$key = "$httpMethod|$pathInfo";

//O array de rotas tem uma entrada para GET|/novo-video? Sim? Então pega o valor dela

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];

    $semRepositorio = [
    Src\Controller\LoginController::class,
    Src\Controller\LogoutController::class,
];

if (in_array($controllerClass, $semRepositorio)) {
    $controller = new $controllerClass();
} else {
    $controller = new $controllerClass($videoRepository);
}
} else {
    $controller = new Error404Controller();
}
/** @var Controller $controller */

$factory = new Psr17Factory();
$creator = new ServerRequestCreator($factory, $factory, $factory, $factory);
$request = $creator->fromGlobals();

$response = $controller->processaRequisicao($request);

http_response_code($response->getStatusCode());

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header("$name: $value", false);
    }
}

echo $response->getBody();
