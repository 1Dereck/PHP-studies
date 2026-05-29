<x-guest-layout>
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input id="password" type="password" name="password" class="form-control" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                <label for="remember_me" class="form-check-label">Lembrar de mim</label>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="d-flex flex-column gap-1">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-muted small text-decoration-none">
                        Esqueceu a senha?
                    </a>
                @endif

                <a href="{{ route('register') }}" class="text-primary small text-decoration-none">
                    Criar conta
                </a>
            </div>

            <button type="submit" class="btn btn-dark">
                Entrar
            </button>
        </div>
    </form>
</x-guest-layout>
