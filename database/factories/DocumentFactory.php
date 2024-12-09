<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Animal;
use App\Models\Document;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idDocument' => $this->faker->word(),
            'Title' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'Document' => $this->faker->word(),
            'animal_id' => Animal::factory(),
        ];
    }
}