<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ url()->previous() }}" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-white tracking-tight">Episódios</h2>
        </div>
    </x-slot>

    @isset($mensagemSucesso)
        <div class="max-w-4xl mx-auto mt-6 mb-6 rounded-xl bg-emerald-500/10 border border-emerald-500/20 p-4 flex items-center gap-3 text-emerald-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ $mensagemSucesso }}</span>
        </div>
    @endisset

    <div class="max-w-4xl mx-auto mt-6">
        <form method="post" class="space-y-6">
            @csrf

            <div class="glass rounded-2xl overflow-hidden shadow-xl">
                <div class="p-6 border-b border-white/5 bg-white/5 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">Lista de Episódios</h3>
                    <span class="text-sm text-gray-400">Marque os episódios assistidos</span>
                </div>

                <div class="divide-y divide-white/5">
                    @foreach ($episodes as $episode)
                        <label class="flex items-center justify-between p-4 sm:p-6 hover:bg-white/5 cursor-pointer transition-colors group">

                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-[#0B0F17] border border-white/10 flex items-center justify-center text-sm font-semibold text-gray-400 group-hover:text-purple-400 transition-colors">
                                    {{ str_pad($episode->number, 2, '0', STR_PAD_LEFT) }}
                                </div>
                                <span class="text-gray-300 font-medium group-hover:text-white transition-colors">
                                    Episódio {{ $episode->number }}
                                </span>
                            </div>

                            <div class="relative flex items-center gap-3">
                                <span class="text-xs font-semibold {{ $episode->watched ? 'text-purple-400' : 'text-gray-500' }}">
                                    {{ $episode->watched ? 'Assistido' : 'Não assistido' }}
                                </span>
                                <input
                                    type="checkbox"
                                    name="episodes[]"
                                    value="{{ $episode->id }}"
                                    class="peer sr-only"
                                    @if ($episode->watched) checked @endif
                                />
                                <div class="relative w-11 h-6 bg-gray-700 rounded-full peer peer-focus:ring-4 peer-focus:ring-purple-500/30 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                            </div>

                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center gap-2 px-8 py-3 text-sm font-semibold text-white bg-purple-600 rounded-xl hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-[#0B0F17] transition-all hover:scale-105 shadow-[0_0_20px_rgba(124,58,237,0.2)]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Salvar Progresso
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
