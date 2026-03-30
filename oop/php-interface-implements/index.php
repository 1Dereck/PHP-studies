<?php

require_once __DIR__ . "/ClassesHerancaAbstrato/Vo.php";
require_once __DIR__ . "/ClassesHerancaAbstrato/Musicista.php";
require_once __DIR__ . "/ClassesHerancaAbstrato/Atleta.php";
require_once __DIR__ . "/ClassesHerancaAbstrato/SerHumano.php";
require_once __DIR__ . "/ClassesHerancaAbstrato/Pai.php";
require_once __DIR__ . "/ClassesHerancaAbstrato/Filho.php";
require_once __DIR__ . "/ClassesHerancaAbstrato/Adotado.php";

$filho = new Filho();
echo $filho->seguirNome();
echo $filho->aprenderInstrumento();
$filho->mudarParaMelhor();

$adotado = new Adotado();
echo $adotado->seguirNome();
echo $adotado->aprenderInstrumento();
$adotado->mudarParaMelhor();
$adotado->tocarInstrumento();
$adotado->correr();
echo $adotado->respirar();
