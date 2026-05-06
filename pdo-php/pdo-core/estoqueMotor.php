<?php

$categoriaBusca = "Motor";

$sql = "SELECT motor FROM estoque WHERE busca = :categoriaMotor";
$stmt = $pdo->prepare($sql);

$stmt->execute(["categoriaMotor" => $categoriaBusca]);

$motores = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($motores as $mot) {
    echo "Motores: " . $mot["motor"];
}
