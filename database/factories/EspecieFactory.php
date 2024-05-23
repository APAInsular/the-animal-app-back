<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Especie;
// made by Lucas

class EspecieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Especie::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->word,  // Generates a unique word for the name
        ];
    }
}
