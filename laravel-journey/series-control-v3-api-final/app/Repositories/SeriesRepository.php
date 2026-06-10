<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;

// Interface que define o contrato para o repositório de séries
interface SeriesRepository
{
    public function addSerie(SeriesFormRequest $request): Series;
}
