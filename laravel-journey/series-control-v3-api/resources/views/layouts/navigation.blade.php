{{-- Sidebar Desktop --}}
<aside class="hidden lg:flex lg:flex-col lg:w-72 lg:fixed lg:inset-y-0 z-20 bg-[#111827] border-r border-white/5">
    @include('layouts.parciais.sidebar-content')
</aside>

{{-- Sidebar Mobile --}}
<div id="mobile-sidebar"
     class="fixed inset-0 z-40 lg:hidden -translate-x-full transition-transform duration-300 ease-in-out"
     role="dialog"
     aria-modal="true">
    {{-- Overlay --}}
    <div class="fixed inset-0 bg-gray-950/85 backdrop-blur-xs"
         onclick="document.getElementById('mobile-sidebar').classList.add('-translate-x-full')"></div>

    {{-- Panel --}}
    <aside class="relative flex flex-col w-72 max-w-xs h-full bg-[#111827] border-r border-white/5">
        @include('layouts.parciais.sidebar-content')
    </aside>
</div>
