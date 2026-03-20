<?php

class Adotado extends SerHumano implements Vo, Musicista, Atleta {

    public function aprenderInstrumento(): string {
        return "Aprendi a tocar Violão\n";
    }

    public function mudarParaMelhor(): bool {
        echo "Mudei de cidade para melhor\n";
        return true;
    }

    public function seguirNome(): string {
        return "Carlos Silva\n";
    }

    public function tocarInstrumento(): void {
        echo "Tocando violão!\n";
    }

    public function correr(): void {
        echo "Correndo!\n";
    }
}
