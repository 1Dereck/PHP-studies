<?php

class Serie extends Titulo implements Avaliavel {

    public function __construct(
        string $nome,
        int $anoLancamento, 
        Genero $genero,
        public readonly int $temporadas,
        public readonly int $episodiosPorTemporada,
        public readonly int $minutosPorEpisodio
        ) {
        parent::__construct($nome, $anoLancamento, $genero);
    }

    #[Override]
    // Evita bug silencioso
    // Indica explicitamente quem o método esta subrescrevendo um
    // método da classe pai
    public function duracaoEmMinutos(): int
    {
        return $this->temporadas * $this->episodiosPorTemporada * $this->minutosPorEpisodio;
    }
}