<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Animal;
use App\Models\Microchip;

class MicrochipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Microchip::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idMicrochip' => $this->faker->word(),
            'NumChip' => $this->faker->word(),
            'animal_id' => Animal::factory(),
        ];
    }
}
