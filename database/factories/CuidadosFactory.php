<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Animal;
use App\Models\Cuidados;
// made by Lucas

class CuidadosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cuidados::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            // 'animal_id' => \App\Models\Animal::factory(), // This will automatically create an Animal as needed
        ];
    }
}
