<?php

$valorMinimo = 15;

// 1. Arrume o sinal de 'maior' e escolha um nome para o placeholder
$sql = "SELECT nome_cafe, preco FROM cardapio WHERE preco >= :precoMinimo";
$stmt = $pdo->prepare($sql);

// 2. No array, use o MESMO nome que você escolheu acima
$stmt->execute(["precoMinimo" => $valorMinimo]);

$cafes = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($cafes as $cafe) {
    echo "Café: " . $cafe["nome_cafe"] . " - R$ " . $cafe["preco"] . "<br>";
}