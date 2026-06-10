<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Series</h2>
        <p class="text-sm text-gray-600 mt-1">Insira suas credenciais para gerenciar suas séries e episódios.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nome@email.com"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Manter-me conectado') }}</span>
            </label>
        </div>

        <!-- Esqueci minha senha -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Esqueceu a senha?') }}
                </a>
            @endif

            <!-- Botão Entrar -->
            <x-primary-button class="ms-3 px-4 py-3 text-black!">
                {{ __('Entrar') }}
            </x-primary-button>
        </div>

        <div class="border-t border-neutral-800/60 my-2"></div>

        <div class="space-y-3 pt-2">

            @if (Route::has('register'))
                <div class="text-center">
                    <p class="text-xs text-neutral-400">
                        Não tem uma conta?
                        <a class="font-bold text-gray-900 hover:text-black underline transition-colors ml-1" href="{{ route('register') }}">
                            {{ __('Cadastre-se') }}
                        </a>
                    </p>
                </div>
            @endif
        </div>

    </form>
</x-guest-layout>
