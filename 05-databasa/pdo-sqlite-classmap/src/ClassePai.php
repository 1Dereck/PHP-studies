<?php

namespace App;

class ClassePai {

    private ?int $id;
    private string $nome;
    private float $altura;

    public function __construct(?int $id, string $nome, float $altura) {
        $this->id = $id;
        $this->nome = $nome;
        $this->altura = $altura;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getAltura(): float {
        return $this->altura;
    }
}