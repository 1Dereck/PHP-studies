<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Routing\Controllers\Middleware;

class SeriesController extends Controller
{
    // Injeta o repository no controller
    public function __construct(private SeriesRepository $repository)
    {

    }

    // Middleware para autenticação
    public static function middleware(): array
    {
        return [
            new Middleware(Autenticador::class, except: ['index']),
        ];
    }

    // Lê todas as séries do banco de dados
    public function index()
    {
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index', compact('series', 'mensagemSucesso'));
    }

    // Redireciona para a página de criação de séries
    public function create()
    {
        return view('series.create');
    }

    // Adiciona uma série no banco de dados
    public function store(SeriesFormRequest $request)
    {
        $serie = $this->repository->addSerie($request);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$serie->nome} adicionada com sucesso!");
    }

    // Deleta uma série do banco de dados
    public function destroy(Series $serie)
    {
        $serie->delete();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$serie->nome} removida com sucesso!");
    }

    // Redireciona para a página de edição de séries
    public function edit(Series $serie)
    {
        return view('series.edit', compact('serie'));
    }

    // Atualiza uma série no banco de dados
    public function update(SeriesFormRequest $request, Series $serie)
    {
        $serie->update($request->all());
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$serie->nome} atualizada com sucesso!");
    }
}
