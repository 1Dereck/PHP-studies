<?php

namespace Dereck\Solid\Service;

use Dereck\Solid\Model\Pontuavel;

class CalculadorPontuacao
{
    public function recuperarPontuacao(Pontuavel $conteudo): int
    {
        return $conteudo->recuperarPontuacao();
    }
}
