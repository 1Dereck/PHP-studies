<?php

class Filho extends Pai {
    
    public function aprenderInstrumento(): string {
        return "Aprendi a tocar Gaita \n";
    }

    public function mudarParaMelhor(): bool {
        echo "Segui melhorando\n";
        return true;
    }

    // Isto é opcional, não é abstract 
    public function seguirNome(): string {
        $this->nome = "Pedro Maciel";
        return $this->nome;
    }
}