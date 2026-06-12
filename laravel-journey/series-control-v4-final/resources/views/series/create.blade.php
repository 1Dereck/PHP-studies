<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('series.index') }}" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-white tracking-tight">Nova Série</h2>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-6">
        <div class="glass rounded-2xl p-6 sm:p-8 relative overflow-hidden">
            {{-- Decoration --}}
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-purple-500/10 blur-3xl pointer-events-none"></div>

            <form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data" class="relative z-10 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    {{-- Nome --}}
                    <div class="md:col-span-8 space-y-2">
                        <label for="nome" class="block text-sm font-medium text-gray-300">
                            Nome da Série
                        </label>
                        <input
                            type="text"
                            autofocus
                            id="nome"
                            name="nome"
                            class="w-full bg-[#0B0F17]/50 border border-white/10 rounded-xl px-4 py-2.5 text-white placeholder-gray-500 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all"
                            value="{{ old('nome') }}"
                            placeholder="Ex: Breaking Bad"
                        >
                        @error('nome')
                            <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Qtd Temporadas --}}
                    <div class="md:col-span-2 space-y-2">
                        <label for="seasonQty" class="block text-sm font-medium text-gray-300">
                            Temporadas
                        </label>
                        <input
                            type="number"
                            min="1"
                            id="seasonQty"
                            name="seasonQty"
                            class="w-full bg-[#0B0F17]/50 border border-white/10 rounded-xl px-4 py-2.5 text-white placeholder-gray-500 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all"
                            value="{{ old('seasonQty') }}"
                            placeholder="Ex: 5"
                        >
                    </div>

                    {{-- Eps por Temporada --}}
                    <div class="md:col-span-2 space-y-2">
                        <label for="episodesPerSeason" class="block text-sm font-medium text-gray-300 text-nowrap truncate" title="Eps / Temporada">
                            Eps/Temp.
                        </label>
                        <input
                            type="number"
                            min="1"
                            id="episodesPerSeason"
                            name="episodesPerSeason"
                            class="w-full bg-[#0B0F17]/50 border border-white/10 rounded-xl px-4 py-2.5 text-white placeholder-gray-500 focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all"
                            value="{{ old('episodesPerSeason') }}"
                            placeholder="Ex: 10"
                        >
                    </div>
                </div>

                {{-- Capa --}}
                <div class="space-y-2" x-data="imageViewer()">
                    <label class="block text-sm font-medium text-gray-300">
                        Capa da Série (Opcional)
                    </label>
                    <label for="cover" class="mt-2 flex justify-center rounded-xl border border-dashed border-white/20 px-6 py-10 hover:border-purple-500/50 hover:bg-white/5 transition-all group cursor-pointer relative overflow-hidden">
                        
                        {{-- Preview Image --}}
                        <template x-if="imageUrl">
                            <img :src="imageUrl" class="absolute inset-0 w-full h-full object-contain bg-[#0B0F17]/80 backdrop-blur-sm z-10" alt="Preview da Capa">
                        </template>

                        <div class="text-center relative z-20" :class="imageUrl ? 'opacity-0 hover:opacity-100 bg-black/50 p-4 rounded-xl transition-opacity' : ''">
                            <svg class="mx-auto h-12 w-12 text-gray-500 group-hover:text-purple-400 transition-colors" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                            </svg>
                            <div class="mt-4 flex text-sm leading-6 text-gray-400 justify-center">
                                <span class="relative bg-transparent font-semibold text-purple-500 hover:text-purple-400">
                                    <span x-text="imageUrl ? 'Trocar arquivo' : 'Fazer upload de um arquivo'"></span>
                                    <input id="cover" name="cover" type="file" class="sr-only" accept="image/gif, image/jpeg, image/png" @change="fileChosen">
                                </span>
                            </div>
                            <p class="text-xs leading-5 text-gray-500 mt-1">PNG, JPG, GIF até 2MB</p>
                        </div>
                    </label>
                </div>

                <script>
                    function imageViewer() {
                        return {
                            imageUrl: '',
                            fileChosen(event) {
                                this.fileToDataUrl(event, src => this.imageUrl = src)
                            },
                            fileToDataUrl(event, callback) {
                                if (! event.target.files.length) return
                                let file = event.target.files[0],
                                    reader = new FileReader()
                                reader.readAsDataURL(file)
                                reader.onload = e => callback(e.target.result)
                            },
                        }
                    }
                </script>

                <div class="pt-4 border-t border-white/5 flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-purple-600 rounded-xl hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-[#0B0F17] transition-all hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Adicionar Série
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
