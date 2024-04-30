<?php

namespace Database\Factories;
use App\Models\Tienda;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tienda>
 */
class TiendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Tienda::class;
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence,
            'autor' => $this->faker->name,
            'editorial' => $this->faker->company,
            'precio' => $this->faker->randomFloat(2, 100, 500),
        ];
    }
}
