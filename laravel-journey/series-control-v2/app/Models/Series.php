<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Series extends Model
{
    use HasFactory;
    // Campos que podem ser mass assigned
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
