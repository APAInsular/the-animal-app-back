<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Animal;
use App\Models\Race;
use App\Models\Zone;

class AnimalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Animal::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idAnimal' => $this->faker->word(),
            'Description' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'Superpower' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'DateOfBirth' => $this->faker->date(),
            'DateOfDeath' => $this->faker->date(),
            'race_id' => Race::factory(),
            'zone_id' => Zone::factory(),
        ];
    }
}
