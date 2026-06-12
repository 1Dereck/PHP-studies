<x-layout title="Temporadas de {!! $series->nome !!}">

    <div class="mb-4 mt-4 d-flex justify-content-center">
        <img src="{{ asset('storage/' . ($series->cover ?: 'series_cover/default_icon.png')) }}"
            style="height: 350px;"
            alt="Capa da série"
            class="img-fluid">
    </div>

    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('episodes.index', $season->id) }}">
                    Temporada {{ $season->number }}
                </a>

                <span class="badge bg-secondary">
                    {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>

</x-layout>
