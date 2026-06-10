<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    @auth
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">
        Adicionar uma nova série
    </a>
    @endauth

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex gap-2 justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img
                        class="me-3 img-thumbnail"
                        src="{{ asset('storage/' . ($serie->cover ?: 'series_cover/default_icon.png')) }}"
                        style="width: 120px; height: 100px; object-fit: cover;"
                        alt="Capa da série"
                    >
                    @auth<a href="{{ route('seasons.index', $serie->id) }}"> @endauth
                        {{ $serie->nome }}
                    @auth</a> @endauth
                </div>

                @auth
                <span class="d-flex gap-2">
                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            Excluir
                        </button>
                    </form>
                </span>
                @endauth
            </li>
        @endforeach
    </ul>
</x-layout>
