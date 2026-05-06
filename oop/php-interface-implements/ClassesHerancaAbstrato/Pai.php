<?php

abstract class Pai implements Vo {
    abstract public function aprenderInstrumento(): string;
    abstract function mudarParaMelhor(): bool;
    abstract function seguirNome(): string;
}   
