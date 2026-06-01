<x-guest-layout>

    <div class="mb-6">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">
            Redefinir sua senha
        </h1>

        <p class="mt-2 text-sm leading-6 text-gray-600">
            {{ __('Digite seu e-mail para redefinir sua senha') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4 w-full">

            <x-primary-button type="button" class="p-0">
                <a href="{{ route('login') }}"
                    class="text-white! no-underline! hover:text-white! hover:no-underline! block w-full h-full">
                    {{ __('Voltar') }}
                </a>
            </x-primary-button>

            <x-primary-button>
                {{ __('Redefinir Senha') }}
            </x-primary-button>

        </div>

    </form>

</x-guest-layout>
