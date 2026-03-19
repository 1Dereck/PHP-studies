<?php
// A ordem importa
require_once __DIR__ . "/src/Modelo/Genero.php";
require_once __DIR__ . "/src/Modelo/Titulo.php";
require_once __DIR__ . "/src/Modelo/Episodio.php";
require_once __DIR__ . "/src/Modelo/Filme.php";
require_once __DIR__ . "/src/Modelo/Serie.php";
require_once __DIR__ . "/src/Calculos/CalculadoraDeMaratona.php";

echo "Bem-vindo ao ScreenMatch\n";

$filme = new Filme("Thor - Ragnarok", 2021, Genero::SuperHeroi, 180); // Objeto

// Chamando método avalia do objeto $filme
$filme->avalia(10);
$filme->avalia(10);
$filme->avalia(5);
$filme->avalia(5);

var_dump($filme);

echo $filme->media() . PHP_EOL;

echo $filme->anoLancamento . PHP_EOL;

$serie = new Serie("Lost", 2007, Genero::Drama, 10, 20, 30);
$episodio = new Episodio($serie, "Episodio piloto", 1);

echo $serie->nome . PHP_EOL;
echo $serie->anoLancamento . PHP_EOL;
echo $serie->genero->name . PHP_EOL;
echo $serie->temporadas . PHP_EOL;
echo $serie->episodiosPorTemporada . PHP_EOL;
echo $serie->minutosPorEpisodio . PHP_EOL;

$calculadora = new CalculadoraDeMaratona();
$calculadora->inclui($filme);
$calculadora->inclui($serie);
$duracao = $calculadora->duracao();

echo "Para essa maratona, você precisa de $duracao minutos\n";