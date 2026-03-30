<?php

require_once __DIR__ . "/ClassesHerancaAbstrato/Vo.php";
require_once __DIR__ . "/ClassesHerancaAbstrato/Pai.php";
require_once __DIR__ . "/ClassesHerancaAbstrato/Filho.php";

$filho = new Filho();

$filho->seguirNome();
$filho->aprenderInstrumento();
$filho->mudarParaMelhor();

$filho->nome = "Allan Parizotto";

echo $filho->seguirNome();
echo $filho->aprenderInstrumento();
echo $filho->mudarParaMelhor();
