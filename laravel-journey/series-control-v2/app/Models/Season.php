<?php

namespace App\Models;

use App\Models\Series;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function numberOfWatchedEpisodes()
    {
        // SELECT * FROM episodes → carrega tudo → filtra em PHP
        //return $this->episodes->filter(fn($episode) => $episode->watched)->count();

        // SELECT COUNT(*) FROM episodes WHERE watched = true;
        // correto deixa o SQL fazer o trabalho mais rapido
        return $this->episodes()->where('watched', true)->count();
    }
}
