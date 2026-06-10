<x-layout title="Nova Série">

    <form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row align-items-end">
            <div class="col-8">
                <label for="nome" class="form-label">
                    Nome:
                </label>

                <input
                    type="text"
                    autofocus
                    id="nome"
                    name="nome"
                    class="form-control"
                    value="{{ old('nome') }}"
                >
            </div>

            <div class="col-2">
                <label for="seasonsQty" class="form-label">
                    Nº Temporada:
                </label>

                <input
                    type="text"
                    id="seasonQty"
                    name="seasonQty"
                    class="form-control"
                    value="{{ old('seasonQty') }}"
                >
            </div>

            <div class="col-2">
                <label for="episodesPerSeason"
                    class="form-label">
                    Eps / Temporada:
                </label>

                <input type="text"
                    id="episodesPerSeason"
                    name="episodesPerSeason"
                    class="form-control"
                    value="{{ old('episodesPerSeason') }}"
                >
            </div>
        </div>

        @error('nome')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
        @enderror

        <div class="row mt-4 mb-3">

            <div class="col-12">
                <label for="cover"
                    class="form-label">
                    Capa:
                </label>

                <input type="file"
                    id="cover"
                    name="cover"
                    class="form-control"
                    accept="image/gif, image/jpeg, image/png"
                >
            </div>

        </div>

        <button type="submit" class="btn btn-primary">
            Adicionar
        </button>

    </form>

</x-layout>
