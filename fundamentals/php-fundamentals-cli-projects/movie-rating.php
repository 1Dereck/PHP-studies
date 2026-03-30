<?php

echo "Bem-Vindo(a) ao screen math!" . PHP_EOL;

$nomeFilme = "Top Gun";

$nomeArquivo = $argv[0] ?? "NULL informe algo...";
 // sempre o nome do arquivo
$exemolo1 = $argv[1] ?? "exemplo 2";
$exemplo2 = $argv[2] ?? "exemp 3";
$exemplo3 = $argv[3] ?? "exemp 4";
$anoLancamento = 2022;

$notas = 0;

for ($contador = 1; $contador < $argc; $contador++) {
    $notas += $argv[$contador];
}

$quantidadeDeNotas = $argc - 1;

if ($quantidadeDeNotas > 0) {
    $notaFilme = $notas / $quantidadeDeNotas;
} else {
    $notaFilme = 0;
}

$incluidoNoPlano = true;

echo PHP_EOL . $nomeFilme . PHP_EOL;

echo "Arquivo: $nomeArquivo\n";
echo "Ano de lançamento: $anoLancamento\n";
echo "Nota do filme: $notaFilme\n";
echo "Incluido no plano: $incluidoNoPlano\n";

if ($notaFilme >= 9.5) {
    echo "Pela nota o filme concorre ao Oscar!\n";
} elseif ($notaFilme >= 6) {
    echo "Filme comum...\n";
} else {
    echo "Filme péssimo!\n";
}

$genero = match($nomeFilme) {
    "Top Gun" => "Ação",
    "Interestelar" => "Ficção científica",
    "Todo Mundo em Panico" => "Comédia besterol",
    default => "Genero desconhecido"
};

echo "O genero do filme é: $genero\n";

echo "Número de parametros: $argc\n";

// array de arrays associativos
$filme = [
    [
        "nome" => "Thor: Ragnarok",
        "ano" => 2021,
        "nota" => 7.8,
        "genero" => "Super-Heroi"
    ],
    [
        "nome" => "Miranha",
        "ano" => 2020,
        "nota" => 9.1,
        "genero" => "Terror",
    ] 
];

echo $filme[0]["nome"] . PHP_EOL;
echo $filme[0]["ano"] . PHP_EOL;
echo $filme[0]["nota"] . PHP_EOL;
echo $filme[0]["genero"] . PHP_EOL;

echo $filme[1]["nome"] . PHP_EOL;
echo $filme[1]["ano"] . PHP_EOL;
echo $filme[1]["nota"] . PHP_EOL;
echo $filme[1]["genero"] . PHP_EOL;

echo $argc;

echo PHP_EOL .count($filme);
