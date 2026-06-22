<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'tipo' => $this->faker->randomElement(['Cafés da manhã', 'Almoço', 'Janta']),
        'nome' => $this->faker->word() . ' ' . $this->faker->randomElement(['Cremoso', 'Especial', 'Caseiro', 'Gelado']),
        'descricao' => $this->faker->sentence(),
        'imagem' => $this->faker->randomElement([
            'cappuccino-cremoso.jpg',
            'cha-gelado.jpg',
            'chocolate-quente.jpg',
            'pao-de-queijo.jpg',
            'cuscuz-calabresa-catupiry.jpg'
        ]),
        'preco' => $this->faker->randomFloat(2, 5, 50)
        ];
    }
}
