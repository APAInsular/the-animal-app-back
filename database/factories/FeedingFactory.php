<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Feeding;

class FeedingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feeding::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idFeeding' => $this->faker->word(),
            'Title' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'Description' => $this->faker->text(),
        ];
    }
}
