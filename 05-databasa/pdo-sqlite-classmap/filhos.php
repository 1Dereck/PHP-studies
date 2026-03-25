<?php

require_once __DIR__ . "/vendor/autoload.php";
use App\ClassePai;

$bancoBase = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:" . $bancoBase);

$familia = new ClassePai(null, 'Sidfesta', 1.71);

$sqlAdd = "INSERT INTO classeFamilia (nome, altura) VALUES (:nome, :altura);";

$declaracao = $pdo->prepare($sqlAdd);
$declaracao->bindValue(":nome", $familia->getNome());
$declaracao->bindValue( ":altura", $familia->getAltura());

if ($declaracao->execute()) {
    echo "Você é da família !";
}
