<?php

abstract class Pai extends Vo {

    // So daria certo se nao fosse abstract
    /*public function aprenderInstrumento(): string {
        echo "Gaita";
    } */

    // Passa para outra classe (Filho) terceriza função basicamente 
    abstract public function aprenderInstrumento(): string;
    // Ele so daria para realizar se nao fosse uma classe abstract
    abstract public function mudarParaMelhor(): bool;

}