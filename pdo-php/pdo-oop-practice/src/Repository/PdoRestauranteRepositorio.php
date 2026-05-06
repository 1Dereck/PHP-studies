<?php

namespace App\Repository;

use App\Contract\ClassAbstrata;
use App\Model\Restaurante;
use PDO;
use PDOStatement;

class PdoRestauranteRepositorio implements ClassAbstrata {

    private PDO $conexaoPdo;

    public function __construct(PDO $conexaoPdo) {
        $this->conexaoPdo = $conexaoPdo;
    }

    public function pratosDoDia(): array
    {
        $sqlConsulta = 'SELECT * FROM restaurante;';
        $stmt = $this->conexaoPdo->query($sqlConsulta);

        return $this->hidratarLista($stmt);
    }

    public function bebidasDoDia(string $bebida): array {
        
        $sqlConsulta = 'SELECT * FROM restaurante WHERE bebida = ?;';
        $stmt = $this->conexaoPdo->prepare($sqlConsulta);
        $stmt->bindValue(1, $bebida);
        $stmt->execute();

        return $this->hidratarLista($stmt);
    }
    public function hidratarLista(PDOStatement $stmt): array {
        //           $conexaoPdo 
        $restauranteListaDeBanco = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $restauranteLista = [];

        foreach ($restauranteListaDeBanco as $bancoDoRestaurante) {
            $restauranteLista[] = new Restaurante(
                $bancoDoRestaurante['id'],
                $bancoDoRestaurante['prato'],
                $bancoDoRestaurante['bebida'],
            );
        }
        /* Tem como facilitar em vez de usar foreach
            $stmt->setFetchMode(PDO::FETCH_CLASS, Restaurante::class);
            return $stmt->fetchAll();
            Mas isso só funciona se os nomes das colunas baterem com os atributos.
        */
        return $restauranteLista;
    }

    public function adicionar(Restaurante $restaurante): void {
    
        $sql = "INSERT INTO restaurante (prato, bebida) VALUES (:prato, :bebida);";
        // bindValue = Quando executar a query, substitui :prato por esse valor com segurança
        $stmt = $this->conexaoPdo->prepare($sql);
        $stmt->bindValue(':prato', $restaurante->getPrato());
        $stmt->bindValue(':bebida', $restaurante->getBebida());
        
        $stmt->execute();
    }
}
