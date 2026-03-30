<?php

$nome = "Vinicius dos Santos";

// verifica se uma string contém outra string dentro dela
// retornando true ou false
$ehDaMinhaFamilia = str_contains($nome, "Santos");

if ($ehDaMinhaFamilia) {
    echo "$nome é da minha família\n";
} else {
    echo "$nome não é da minha família\n";
}
