<?php

$bancoBase = __DIR__ . "/banco.sqlite";

$pdo = new PDO("sqlite:" . $bancoBase);

echo "Conectei seu animal de instancia\n";

$pdo->exec("CREATE TABLE classeFamilia (id INTEGER PRIMARY KEY, nome TEXT, altura FLOAT);");

echo "Tabela criada";