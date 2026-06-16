<?php

namespace Dereck\Solid\Service;

use Dereck\Solid\Model\Assistivel;

class Assistidor
{
    public function assistir(Assistivel $conteudo): void
    {
        $conteudo->assistir();
    }
}
