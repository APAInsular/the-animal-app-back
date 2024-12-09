<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Zone;

class ZoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Zone::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idZone' => $this->faker->word(),
            'Title' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'Description' => $this->faker->text(),
        ];
    }
}
