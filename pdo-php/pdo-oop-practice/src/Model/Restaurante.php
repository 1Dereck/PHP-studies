<?php

// Objeto de dados: id, prato, bebida

namespace App\Model;

class Restaurante {

    private ?int $id;
    private string $prato;
    private string $bebida;

    public function __construct(?int $id, string $prato, string $bebida) {
        $this->id = $id;
        $this->prato = $prato;
        $this->bebida = $bebida;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getPrato(): string {
        return $this->prato;
    }

    public function getBebida(): string {
        return $this->bebida;
    }
}
