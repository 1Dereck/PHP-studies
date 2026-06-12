<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('series.index') }}" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-white tracking-tight">Editar Série: {!! $serie->nome !!}</h2>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-6">
        <div class="glass rounded-2xl p-6 sm:p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-purple-500/10 blur-3xl pointer-events-none"></div>

            <form action="{{ route('series.update', $serie->id) }}" method="post" class="relative z-10 space-y-6">
                @csrf
                @method('PATCH')

                <div class="space-y-2">
                    <label for="nome" class="block text-sm font-medium text-gray-300">
                        Nome da Série
                    </label>
                    <input
                        type="text"
                        autofocus
                        id="nome"
                        name="nome"
                        class="w-full bg-[#0B0F17]/50 border border-white/10 rounded-xl px-4 py-2.5 text-white placeholder-gray-500 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all"
                        value="{{ old('nome', $serie->nome) }}"
                        placeholder="Ex: Breaking Bad"
                    >
                    @error('nome')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 border-t border-white/5 flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-purple-600 rounded-xl hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-[#0B0F17] transition-all hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Salvar Alterações
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
