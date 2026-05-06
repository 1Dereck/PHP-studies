<?php

namespace Src\Models;

class Video
{
    private ?int $id;
    private string $url;
    private string $titulo;

    public function __construct(string $url, string $titulo) {
        $this->titulo = $titulo;
        $this->setUrl($url);
    }

    private function setUrl(string $url) {
        if(filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('URL inválida seu buceta');
        }
        $this->url = $url;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }
    
}