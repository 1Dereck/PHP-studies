<?php

// Escalares
$string = "Valores textuais";
$int = 27;
$float = 15.5;
$bool = true;

// Compostos
$array = [$string, $int, $float, $bool];

// Conversão de tipos

// Type Cast
$valorNumerico = "27";
$valorInteiro = (int) $valorDecimal;

var_dump($valorInteiro);

$topo = 5;

$opcao = match ($tipo){
    1, 2, 3 => "Saldo",
    4, 10 => "exemplo",
    5, 11 => "Deposito",
    default => null
};
