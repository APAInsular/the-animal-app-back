<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Species;

class SpeciesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Species::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idSpecies' => $this->faker->word(),
            'Name' => $this->faker->regexify('[A-Za-z0-9]{45}'),
        ];
    }
}
