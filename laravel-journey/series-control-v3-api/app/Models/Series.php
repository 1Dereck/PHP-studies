<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    // Oque é fillable e mass assigned?
    // mass assigned é quando vc cria ou atualiza um objeto sem precisar passar todos os campos um por um
    // por exemplo se o objeto fosse assim
    // protected $fillable = ['nome'];
    // e vc fizesse
    // Series::create(['nome' => 'The Boys']);
    // Vc estaria criando um objeto sem passar todos os campos
    // O fillable é um array que contém os campos que podem ser mass assigned
    // se nao tiver o fillable, nao pode ser mass assigned
    protected $fillable = ['nome', 'cover'];
    protected $appends = ['links'];

    // Define o relacionamento de um para muitos entre Series e Season
    public function seasons()
    {
        return $this->hasMany(Season::class, 'serie_id');
    }

    // Define o relacionamento de muitos para muitos entre Series e Episodes
    // Através do relacionamento de um para muitos entre Series e Season
    // E o relacionamento de um para muitos entre Season e Episode
    public function episodes()
    {
        return $this->hasManyThrough(Episode::class, Season::class,
            'serie_id',   // FK da tabela Season na tabela Series
            'season_id',  // FK da tabela Episode na tabela Season
            'id',         // FK da tabela Series na tabela Season
            'id'          // FK da tabela Season na tabela Episode
        );
    }

    // Adiciona um escopo global para ordenar as séries por nome
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder)
        {
            $queryBuilder->orderBy('nome');
        });
    }

    public function links(): Attribute
    {
        return Attribute::make(
            get: fn () =>  [
                [
                    'rel' => 'self',
                    'url' => "/api/series/{$this->id}"
                ],
                [
                    'rel' => 'season',
                    'url' => "/api/seasons/{$this->id}/seasons"
                ],
                [
                    'rel' => 'episodes',
                    'url' => "/api/series/{$this->id}/episodes"
                ]
            ],
        );
    }
}
