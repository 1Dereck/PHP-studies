@component('mail::message')
# {{ $nomeSerie }} criada

A série {{ $nomeSerie }} com {{ $qtdTemporadas }} temporadas e {{ $episodiosPorTemporada }} episódios por temporada foi criada.

@component('mail::button', ['url' => route('seasons.index', ['series' => $idSerie])])
    Ver Séries
@endcomponent

@endcomponent
