// Lista registros

<?php

require_once 'vendor/autoload.php';

use App\Database\CriandoConexao;
use App\Repository\PdoRestauranteRepositorio;

$pdo = CriandoConexao::conexao();

$repo = new PdoRestauranteRepositorio($pdo);

$lista = $repo->pratosDoDia();
//echo $exempro = $repo->hidratarLista();

foreach ($lista as $item) {
    echo $item->getId() . PHP_EOL;
    echo $item->getPrato() . PHP_EOL;
    echo $item->getBebida() . PHP_EOL;
}
