<?php

namespace App\Database;

use PDO;

class CriandoConexao {
    public static function conexao(): PDO {

        $bancoUsado = __DIR__ . "/../../banco.sqlite";
        return new PDO("sqlite:" . $bancoUsado);

    }
}
