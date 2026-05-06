<?php

require_once __DIR__ . "/vendor/autoload.php";

use App\Infrastructure\ClassePai;
use App\Infrastructure\PdoFamiliaRepository;
use App\Infrastructure\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::createConnection();

$familia = new ClassePai(null, 'Sidfesta', 1.71);
$repositorio = new PdoFamiliaRepository($pdo);

if ($repositorio->salvar($familia)) {
    echo "Você é da família!";
}
