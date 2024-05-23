<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Alimentacion;
use App\Models\Animal;
// made by Lucas

class AlimentacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Alimentacion::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tipo' => $this->faker->word(),
            'cantidad' => $this->faker->numberBetween(1, 100),
            // 'animal_id' => Animal::factory(), // Ensure that this is uncommented only if the Animal table is seeded first
        ];
    }
}
