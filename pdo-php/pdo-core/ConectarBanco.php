<?php

class ConectarBanco {

    public static function bancoConectado() : PDO {
        $banco = "\banco.sqlite";
        return new PDO("sqlite" . $banco);
    }
}