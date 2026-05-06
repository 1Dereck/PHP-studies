<?php

echo "-------------------------------------\n";
echo "         Seja bem vindo!\n";
echo "-------------------------------------\n";
$saldo = 1000.00;

do {

    echo "1. Consultar saldo atual\n";
    echo "2. Sacar valor\n";
    echo "3. Depositar valor\n";
    echo "4. Sair\n";

    $opcao = (int) fgets(STDIN);
    
    switch($opcao) {
        case 1:
            echo "Saldo: $saldo reais\n";
            break;

        case 2:
            echo "Digite o valor que deseja sacar: ";
            $sacar = (float) fgets(STDIN);

            if ($sacar <= 0) {
                echo "Valor inválido!\n";
                echo "Tente novamente com um valor valido\n";
            } elseif ($sacar > $saldo) {
                echo "Saldo insuficiente para realizar este saque!\n";

            } else {
                $saldo -= $sacar;
                echo "Saldo realizado com sucesso! Saldo atual: $saldo reais\n";
            }
            break;
        
        case 3:
            echo "Informe o valor a ser depositado: ";
            $depositar = (float) fgets(STDIN);
            $saldo += $depositar;
            break;
        
        case 4:
            echo "Até logo....\n";
            break;
        
        default:
            echo "Opção inválida\n";
            break;
    }
    
} while($opcao != 4);
