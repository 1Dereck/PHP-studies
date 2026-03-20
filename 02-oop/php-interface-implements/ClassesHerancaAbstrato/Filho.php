<?php

class Filho extends Pai {

    public function aprenderInstrumento(): string {
        return "Aprendi a tocar Gaita \n";
    }

    public function mudarParaMelhor(): bool {
        echo "Segui melhorando\n";
        return true;
    }

    public function seguirNome(): string {
        return "Pedro Maciel\n";
    }
}
