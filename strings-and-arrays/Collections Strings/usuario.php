<?php

$nome = "Dereck Maciel";
$email = "dereck@gmail.com";
$senha = "123";

// echo mb_strlen($senha) . PHP_EOL;

if (strlen($senha) < 8) {
    echo "Senha insegura\n";
} else {
    echo "Senha segura\n";
}

echo strlen($senha) . PHP_EOL;

$posicaoDoArroba = strpos($email, "@"); // buscar a posição

echo substr($email, 0, $posicaoDoArroba) , PHP_EOL;
echo substr($email, $posicaoDoArroba + 1) , PHP_EOL;

$usuario = substr($email, 0, $posicaoDoArroba);

// echo mb_strtoupper($usuario) . PHP_EOL;
echo substr($email, $posicaoDoArroba + 1) . PHP_EOL;

// var_dump(explode("", $nome));
