<x-app-layout>
    <x-slot name="header">
        Catálogo de Séries
    </x-slot>

    @isset($mensagemSucesso)
        <div class="mb-6 rounded-xl bg-emerald-500/10 border border-emerald-500/20 p-4 flex items-center gap-3 text-emerald-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ $mensagemSucesso }}</span>
        </div>
    @endisset

    @auth
        <div class="mb-8 flex justify-end">
            <a href="{{ route('series.create') }}" class="group relative inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold text-white transition-all duration-300 bg-purple-600 rounded-full hover:bg-purple-500 hover:scale-105 hover:shadow-[0_0_20px_rgba(124,58,237,0.3)] focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-[#0B0F17]">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Adicionar Nova Série
            </a>
        </div>
    @endauth

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
        @foreach ($series as $serie)
            <div class="group relative flex flex-col rounded-2xl glass overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_10px_40px_-10px_rgba(124,58,237,0.3)] hover:border-purple-500/30">

                {{-- Imagem da Capa --}}
                <div class="relative aspect-2/3 overflow-hidden bg-gray-800">
                    <img
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        src="{{ $serie->cover ? asset('storage/' . $serie->cover) : 'https://placehold.co/400x600/111827/7C3AED?text=Sem+Capa' }}"
                        alt="Capa da série {{ $serie->nome }}"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-[#0B0F17] via-[#0B0F17]/20 to-transparent opacity-80 group-hover:opacity-60 transition-opacity"></div>

                    {{-- Ações Overlay (Editar / Excluir) --}}
                    @auth
                        <div class="absolute top-2 right-2 flex flex-col gap-2 z-20 translate-x-10 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300">
                            <a href="{{ route('series.edit', $serie->id) }}" class="p-2 rounded-full bg-black/50 backdrop-blur-md text-gray-300 hover:text-white hover:bg-purple-600/80 transition-colors relative z-20" title="Editar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="m-0 p-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-full bg-black/50 backdrop-blur-md text-gray-300 hover:text-white hover:bg-red-500/80 transition-colors relative z-20" title="Excluir">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>

                {{-- Título / Link --}}
                <div class="absolute bottom-0 w-full p-4 z-10">
                    <h3 class="text-sm font-semibold text-white line-clamp-2 leading-tight">
                        @auth
                            <a href="{{ route('seasons.index', $serie->id) }}" class="after:absolute after:inset-0">
                                {{ $serie->nome }}
                            </a>
                        @else
                            {{ $serie->nome }}
                        @endauth
                    </h3>
                </div>

            </div>
        @endforeach
    </div>
</x-app-layout>
