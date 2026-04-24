<?php

namespace Models;

class Produto {

    private ?int $id;
    private string $tipo;
    private string $nome;
    private string $descricao;
    private string $imagem;
    private float $preco;

    /* $imagem = "logo-serenatto.png", serve para definir que se caso nao preencher 
     * com imagem ele vai seguir essa logo-serenatto.png como padrão. 
    */
    
    public function __construct(?int $id, string $tipo, string $nome, string $descricao, float $preco, string $imagem = "logo-serenatto.png")
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->preco = $preco;
    }

    public function getId(): ?int {
        return $this->id;
    }

    // Setters serve para alterar dados de uma variável.
    
    public function setImagem(string $imagem): void {
        $this->imagem = $imagem;
    }

    public function getTipo(): string {
        return $this->tipo;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function getImagem(): string {
        return $this->imagem;
    }

    public function getImagemFormatado(): string {
        return 'img/'.$this->getImagem();
    }

    public function getPreco(): float {
        return $this->preco;
    }

    public function getPrecoFormatado(): string {
        // Usado o ',' e o '.' para formatar o preço em Reais (R$)
        // de acordo com o padrão brasileiro. Ex: 10.999,99
        return "R$ " . number_format($this->preco, 2, ',', '.');
    }    
}
