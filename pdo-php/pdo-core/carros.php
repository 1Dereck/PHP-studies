<?php

use ConectarBanco;

$pdo = ConectarBanco::bancoConectado();

$anoMinimoLancamentoCarro = 2010;

$sql = "SELECT id, modelo, ano FROM carros WHERE minLancamento >= :lancamentoCarro";
$stmt = $pdo->prepare($sql);

$stmt->execute(["ano"=> $anoMinimoLancamentoCarro]);

$anoMaior = $stml->fetchALL(PDO::FETCH_ASSOC);

foreach ($anoMaior as $anoVendo) {
    echo $anoVendo["id"] . $anoVendo["modelo"] . PHP_EOL;
}
