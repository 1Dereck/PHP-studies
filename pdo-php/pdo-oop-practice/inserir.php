
// Adicionar registro

<?php

require_once 'vendor/autoload.php';

use App\Database\CriandoConexao;
use App\Model\Restaurante;
use App\Repository\PdoRestauranteRepositorio;
// use App\Repository\PdoRestauranteRepositorio;

$pdo = CriandoConexao::conexao();

$repo = new PdoRestauranteRepositorio($pdo);

$restaurante = new Restaurante(null, "pizza", "Itubaina");

$repo->adicionar($restaurante);

echo "Dados inseridos com sucesso!\n";