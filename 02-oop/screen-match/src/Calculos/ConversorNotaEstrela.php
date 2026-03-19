<?php

class ConversorNotaEstrela {
    public function conversor (Avaliavel $avaliavel): float {
        
        $nota = $avaliavel->media();

        // Realize a conversão
        // round = arredonda 
        // Agora nota ia de 1 a 10 ele arredonda a nota e / 2
        // Tornando as estrelas de avaliação fique entre 0 a 5
        return round($nota) / 2;
    }

}