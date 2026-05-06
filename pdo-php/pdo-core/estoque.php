<?php

$quantidadeLimite = 10;

$sqlite = "SELECT quantidade, coxinha FROM panificadora WHERE quantidade <= :limite";
$comando = $pdo->prepare($sqlite);

$comando->execute(["limite" => $quantidadeLimite]);

$listaDeEstoque = $comando->fetchALL(PDO::FETCH_ASSOC);

foreach($listaDeEstoque as $lista) {
    echo "Quantidade: " . $lista["quantidade"] . " | Coxinha: " . $lista["coxinha"];
}