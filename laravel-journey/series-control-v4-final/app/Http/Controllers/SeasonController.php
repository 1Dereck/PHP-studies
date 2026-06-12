<?php

namespace App\Http\Controllers;

use App\Models\Series;

class SeasonController extends Controller
{
    public function index(Series $serie)
    {
        $seasons = $serie->seasons()
            ->with('episodes')
            ->get();

        return view('seasons.index')
            ->with('seasons', $seasons)
            ->with('series', $serie);
    }
}
