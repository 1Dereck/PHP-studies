<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CryptoFinance') }} — {{ $header ?? 'Dashboard' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=jetbrains-mono:500,600&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg: #0B0F17;
            --surface: #111827;
            --surface-2: #161E2E;
            --border: rgba(255, 255, 255, 0.06);
            --text: #E5E7EB;
            --muted: #8B93A7;
            --primary: #7C3AED;
            --accent: #3B82F6;
            --btc: #F7931A;
            --success: #10B981;
            --danger: #EF4444;
        }

        html,
        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', system-ui, sans-serif;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .glass {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0)), var(--surface);
            border: 1px solid var(--border);
        }

        .glow-btc {
            box-shadow: 0 0 0 1px rgba(247, 147, 26, 0.15), 0 8px 30px -10px rgba(247, 147, 26, 0.35);
        }

        .glow-primary {
            box-shadow: 0 0 0 1px rgba(124, 58, 237, 0.2), 0 10px 40px -10px rgba(124, 58, 237, 0.5);
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #2A3344;
            border-radius: 999px;
        }
    </style>
</head>

<body class="min-h-screen antialiased bg-[#0B0F17] text-gray-200">

    {{-- Background ambient gradients --}}
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-[500px] h-[500px] rounded-full bg-purple-600/10 blur-3xl"></div>
        <div class="absolute top-1/3 -right-40 w-[600px] h-[600px] rounded-full bg-blue-600/10 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 w-[400px] h-[400px] rounded-full bg-orange-500/5 blur-3xl"></div>
    </div>

    <div class="relative flex min-h-screen">

        {{-- Sidebar (desktop) --}}
        @include('layouts.navigation')

        {{-- Main content area --}}
        <div class="flex-1 flex flex-col lg:ml-72">

            {{-- Top bar --}}
            <header class="sticky top-0 z-30 backdrop-blur-xl bg-[#0B0F17]/70 border-b border-white/5">
                <div class="flex items-center justify-between gap-4 px-4 sm:px-6 lg:px-8 h-16">

                    {{-- Mobile menu trigger --}}
                    <button type="button"
                        onclick="document.getElementById('mobile-sidebar').classList.toggle('-translate-x-full')"
                        class="lg:hidden p-2 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    {{-- Greeting --}}
                    <div class="hidden md:block">
                        <p class="text-xs text-gray-500">{{ now()->translatedFormat('l, d \d\e F') }}</p>
                        @auth
                            <h1 class="text-sm font-semibold text-white">
                                Olá, <span class="text-orange-400">{{ explode(' ', auth()->user()->name)[0] }}</span> 👋
                            </h1>
                        @endauth
                    </div>

                    {{-- Right side: search / notifications / avatar --}}
                    <div class="flex items-center gap-2 ml-auto">

                        <div
                            class="hidden md:flex items-center gap-2 px-3 py-2 rounded-xl bg-white/5 border border-white/5 w-72">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                            </svg>
                            <input type="text" placeholder="Buscar transações, ativos..."
                                class="bg-transparent border-0 outline-none focus:ring-0 text-sm text-gray-200 placeholder-gray-500 w-full p-0">
                        </div>

                        {{-- BTC ticker mini --}}
                        <div
                            class="hidden sm:flex items-center gap-2 px-3 py-2 rounded-xl bg-gradient-to-r from-orange-500/10 to-orange-500/5 border border-orange-500/20">
                            <div class="w-2 h-2 rounded-full bg-orange-400 animate-pulse"></div>
                            <span class="text-xs text-gray-400">BTC</span>
                            <span class="text-xs font-mono font-semibold text-orange-400">R$ 358.420</span>
                            <span class="text-[10px] font-mono text-emerald-400">+2.4%</span>
                        </div>

                        {{-- Notifications --}}
                        <button
                            class="relative p-2 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0" />
                            </svg>
                            <span
                                class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-orange-400 ring-2 ring-[#0B0F17]"></span>
                        </button>

                        {{-- Avatar --}}
                        @auth
                            <div class="flex items-center gap-2 pl-2 ml-1 border-l border-white/5">
                                <div
                                    class="w-9 h-9 rounded-xl bg-gradient-to-br from-purple-500 to-blue-500 flex items-center justify-center text-white text-sm font-semibold ring-2 ring-white/5">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </header>

            {{-- Page Heading (optional Breeze slot) --}}
            @isset($header)
                <div class="px-4 sm:px-6 lg:px-8 pt-6">
                    <div class="text-gray-400 text-sm">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            {{-- Page Content --}}
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
                {{ $slot }}
            </main>

            <footer class="px-4 sm:px-6 lg:px-8 py-4 text-xs text-gray-600 text-center border-t border-white/5">
                © {{ date('Y') }} {{ config('app.name') }} · Stay humble, stack sats. ⚡
            </footer>
        </div>
    </div>

</body>

</html>
