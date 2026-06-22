<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    // HasFactory permite testar automagicamente com factories
    use HasFactory;

    // lista de colunas que podem ser preenchidas via Eloquent (mass assignment)
    protected $fillable = [
        'tipo',
        'nome',
        'descricao',
        'imagem',
        'preco'
    ];

}
