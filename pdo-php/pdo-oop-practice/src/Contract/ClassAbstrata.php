<?php

// Interface (Contract) define o contrato

namespace App\Contract;

interface ClassAbstrata {
    
    public function pratosDoDia(): array;
    public function bebidasDoDia(string $bebida): array;

}
