@props([
    'action',
    'nome' => '',
    'update' => false
])

<form action="{{ $action }}" method="post">
    @csrf

    @if ($update)
        @method('PATCH')
    @endif

    <div class="mb-3">
        <label for="nome" class="form-label">
            Nome:
        </label>

        <input
            type="text"
            id="nome"
            name="nome"
            class="form-control"
            value="{{ $nome }}"
        >
    </div>

    @error('nome')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror

    <button type="submit" class="btn btn-primary">
        {{ $update ? 'Atualizar' : 'Adicionar' }}
    </button>
</form>
