<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('series.index') }}" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-white tracking-tight">Temporadas de: <span class="text-purple-400">{!! $series->nome !!}</span></h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-6 flex flex-col md:flex-row gap-8">

        {{-- Poster da Série --}}
        <div class="md:w-1/3 lg:w-1/4 shrink-0">
            <div class="rounded-2xl overflow-hidden glass p-2 shadow-[0_0_40px_-10px_rgba(124,58,237,0.2)]">
                <div class="relative aspect-2/3 rounded-xl overflow-hidden">
                    <img
                        src="{{ $series->cover ? asset('storage/series_cover/' . basename($series->cover)) : 'https://placehold.co/400x600/111827/7C3AED?text=Sem+Capa' }}"
                        alt="Capa de {{ $series->nome }}"
                        class="absolute inset-0 w-full h-full object-cover"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-[#0B0F17] via-transparent to-transparent opacity-80"></div>
                </div>
            </div>
        </div>

        {{-- Lista de Temporadas --}}
        <div class="flex-1 space-y-4">
            @foreach ($seasons as $season)
                <a href="{{ route('episodes.index', $season->id) }}" class="group block">
                    <div class="glass rounded-2xl p-6 transition-all duration-300 hover:bg-white/5 hover:-translate-y-1 hover:shadow-[0_10px_40px_-10px_rgba(124,58,237,0.2)] hover:border-purple-500/30 flex items-center justify-between">

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-purple-500/20 text-purple-400 flex items-center justify-center font-bold text-lg group-hover:bg-purple-500 group-hover:text-white transition-colors">
                                {{ $season->number }}
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white group-hover:text-purple-300 transition-colors">Temporada {{ $season->number }}</h3>
                                <p class="text-sm text-gray-400 mt-1">Clique para ver os episódios</p>
                            </div>
                        </div>

                        {{-- Progresso / Badge --}}
                        <div class="flex items-center gap-4">
                            @php
                                $watched = $season->numberOfWatchedEpisodes();
                                $total = $season->episodes->count();
                                $percent = $total > 0 ? round(($watched / $total) * 100) : 0;
                            @endphp

                            <div class="hidden sm:flex flex-col items-end gap-2">
                                <span class="text-sm font-medium text-gray-300">{{ $watched }} / {{ $total }} assistidos</span>
                                <div class="w-32 h-2 rounded-full bg-gray-800 overflow-hidden">
                                    <div class="h-full bg-purple-500 transition-all duration-500" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>

                            <svg class="w-6 h-6 text-gray-600 group-hover:text-purple-400 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</x-app-layout>
