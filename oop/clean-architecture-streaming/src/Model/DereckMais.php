<?php

namespace Dereck\Solid\Model;

use Dereck\Solid\Model\Video;
use Dereck\Solid\Model\Pontuavel;

class AluraMais extends Video implements Pontuavel, Assistivel
{
    private string $categoria;

    public function __construct(string $nome, string $categoria)
    {
        parent::__construct($nome);
        $this->categoria = $categoria;
    }

    public function recuperarUrl(): string
    {
        return 'http://videos.alura.com.br/' . str_replace(' ', '-', strtolower($this->categoria));
    }

    public function recuperarPontuacao(): int
    {
        return $this->minutosDeDuracao() * 2;
    }
}
