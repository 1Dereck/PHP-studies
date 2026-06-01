{{-- ============================================================
     Conteúdo interno reaproveitado pela sidebar desktop e mobile
     ============================================================ --}}

@php
    function navIcon($name) {
        return match($name) {
            'home'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3v-6h6v6h3a1 1 0 001-1V10"/>',
            'trending' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l6-6 4 4 8-8M14 7h7v7"/>',
            'wallet'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7zm0 0V5a2 2 0 012-2h11l4 4M16 14h2"/>',
            'target'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22a10 10 0 100-20 10 10 0 000 20zm0-4a6 6 0 100-12 6 6 0 000 12zm0-4a2 2 0 100-4 2 2 0 000 4z"/>',
            'cog'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.3 3.6a1 1 0 011.4 0l1.1 1.1a1 1 0 00.9.3l1.5-.3a1 1 0 011.2.7l.4 1.5a1 1 0 00.6.7l1.4.6a1 1 0 01.5 1.3l-.5 1.4a1 1 0 000 .8l.5 1.4a1 1 0 01-.5 1.3l-1.4.6a1 1 0 00-.6.7l-.4 1.5a1 1 0 01-1.2.7l-1.5-.3a1 1 0 00-.9.3l-1.1 1.1a1 1 0 01-1.4 0L9.2 18a1 1 0 00-.9-.3l-1.5.3a1 1 0 01-1.2-.7l-.4-1.5a1 1 0 00-.6-.7L3.2 14a1 1 0 01-.5-1.3l.5-1.4a1 1 0 000-.8L2.7 9a1 1 0 01.5-1.3l1.4-.6a1 1 0 00.6-.7l.4-1.5a1 1 0 011.2-.7l1.5.3a1 1 0 00.9-.3L10.3 3.6zM12 15a3 3 0 100-6 3 3 0 000 6z"/>',
            default    => '',
        };
    }

    $navItems = $navItems ?? [
        [
            'label' => 'Séries',
            'route' => 'series.index',
            'icon'  => 'home',
        ],
        [
            'label' => 'Meu Perfil',
            'route' => 'profile.edit',
            'icon'  => 'cog',
        ],
    ];
@endphp

{{-- Logo --}}
<div class="flex items-center gap-3 px-6 h-16 border-b border-white/5">
    <div class="w-9 h-9 rounded-xl bg-linear-to-br from-purple-600 to-indigo-600 flex items-center justify-center text-white font-bold text-lg glow-primary">
        🎬
    </div>
    <div>
        <h2 class="text-white font-semibold text-sm tracking-tight">{{ config('app.name', 'Controle de Séries') }}</h2>
        <p class="text-[10px] text-gray-500 font-mono uppercase tracking-widest">Organize · Assista · Controle</p>
    </div>

    {{-- Close button (mobile only) --}}
    <button type="button"
            onclick="document.getElementById('mobile-sidebar').classList.add('-translate-x-full')"
            class="lg:hidden ml-auto p-2 text-gray-500 hover:text-white">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>

{{-- Nav links --}}
<nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto scrollbar-thin">
    <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-widest text-gray-600">Menu</p>

    @foreach($navItems as $item)
        @php
            $isActive = request()->routeIs($item['route']);
        @endphp

        <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
           class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                  {{ $isActive
                        ? 'bg-linear-to-r from-purple-600/20 to-indigo-600/10 text-white border border-purple-500/20 shadow-[inset_0_1px_0_0_rgba(255,255,255,0.05)]'
                        : 'text-gray-400 hover:text-white hover:bg-white/5' }}">

            <span class="w-5 h-5 flex items-center justify-center {{ $isActive ? 'text-purple-400' : 'text-gray-500 group-hover:text-gray-300' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! navIcon($item['icon']) !!}
                </svg>
            </span>
            <span class="flex-1">{{ $item['label'] }}</span>

            @if($isActive)
                <span class="w-1.5 h-1.5 rounded-full bg-purple-400"></span>
            @endif
        </a>
    @endforeach

    {{-- Highlight card --}}
    <div class="mt-8 p-4 rounded-2xl bg-linear-to-br from-purple-500/10 via-indigo-600/10 to-transparent border border-purple-500/15">
        <div class="flex items-center gap-2 mb-2">
            <span class="text-purple-400 text-lg">🍿</span>
            <p class="text-xs font-semibold text-white">Progresso Geral</p>
        </div>
        <p class="text-[11px] text-gray-400 leading-relaxed mb-3">Organize suas séries favoritas e controle seus episódios assistidos!</p>
    </div>
</nav>

{{-- Footer: user + logout --}}
@auth
<div class="border-t border-white/5 p-4">
    <div class="flex items-center gap-3 mb-3">
        <div class="w-10 h-10 rounded-xl bg-linear-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-white text-sm font-semibold ring-2 ring-white/5 shrink-0">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div class="min-w-0 flex-1">
            <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl text-sm font-medium text-gray-400 hover:text-white bg-white/5 hover:bg-red-500/10 hover:border-red-500/20 border border-white/5 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Sair
        </button>
    </form>
</div>
@endauth

@guest
<div class="border-t border-white/5 p-4 space-y-2">
    <a href="{{ route('login') }}" class="block text-center w-full px-3 py-2 rounded-xl text-sm font-medium text-white bg-linear-to-r from-purple-600 to-indigo-600 hover:opacity-90 transition">
        Entrar
    </a>
    <a href="{{ route('register') }}" class="block text-center w-full px-3 py-2 rounded-xl text-sm font-medium text-gray-400 hover:text-white border border-white/5 transition">
        Criar conta
    </a>
</div>
@endguest
