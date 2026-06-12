<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['number'];
    protected $casts = ['watched' => 'boolean'];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    /* Oque é um Accessor?
    // Um accessor é um metodo que permite que vc formate os dados de uma coluna
    // antes de serem acessados
    // Por exemplo, se vc tem uma coluna watched que é um booleano
    // vc pode criar um accessor para que ela seja sempre retornada como true ou false
    protected function watched(): Attribute
    {
        return Attribute::make(
            get: fn ($watched) => (bool) $watched,
            set: fn ($watched) => (bool) $watched,
        );
    }
    */
}
