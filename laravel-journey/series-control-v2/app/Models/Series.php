<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

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
    protected $fillable = ['nome'];

    // Define o relacionamento de um para muitos entre Series e Season
    public function seasons()
    {
        return $this->hasMany(Season::class, 'serie_id');
    }

    // Adiciona um escopo global para ordenar as séries por nome
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder)
        {
            $queryBuilder->orderBy('nome');
        });
    }
}
