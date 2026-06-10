<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Events\SeriesCreated;
use App\Models\Series;
use App\Repositories\SeriesRepository;
//use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SeriesController extends Controller
{
    // Injeta o repository no controller
    public function __construct(private SeriesRepository $repository)
    {
        //
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
        $coverPath = $request->hasFile('cover')
            ? $request->file('cover')->store('series_cover', 'public')
            : null;

        $request->merge([
            'coverPath' => $coverPath
        ]);

        $serie = $this->repository->addSerie($request);

        SeriesCreated::dispatch(
            $serie->nome,
            $serie->id,
            $request->seasonQty,
            $request->episodesPerSeason
        );

        return to_route('series.index')
            ->with(
                'mensagem.sucesso',
                "Série '{$serie->nome}' adicionada com sucesso"
        );
    }

    // Deleta uma série do banco de dados
    public function destroy(Series $serie)
    {
        $cover = $serie->cover;

        $serie->delete();

        if ($cover && Storage::disk('public')->exists($cover)) {
            Storage::disk('public')->delete($cover);
        }

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
        $serie->update($request->validated());
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$serie->nome} atualizada com sucesso!");
    }

    public static function middleware(): array
    {
        return [
            new Middleware(Autenticador::class, except: ['index']),
        ];
    }
}
