<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::query()->orderBy('nome')->get();

        // return view('listar-series', ['series' => $series]);
        // listar-series é o nome do arquivo lisar-series.php 
        // compact é uma função que cria um array com o nome da variável, 
        // série neste caso é a chave do array e $series é o valor
        // então é como fazer ['series' => $series]

        return view('series.index', compact('series'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $nomeSerie = $request->input('nome');
        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save();

        // DB::insert('INSERT INTO series (nome) VALUES (:nome)', [$nomeSerie]);

        return redirect('/series');
    }
}
