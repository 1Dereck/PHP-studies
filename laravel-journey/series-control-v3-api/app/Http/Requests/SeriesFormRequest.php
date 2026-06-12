<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'min:2', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Por favor, insira o nome da série.',
            'nome.min' => 'O nome da série deve ter pelo menos 2 caracteres.',
            'nome.max' => 'O nome da série deve ter no máximo 100 caracteres.',
        ];
    }
}
