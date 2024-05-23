<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Formacion;
// made by Lucas

class FormacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Formacion::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'fecha_inicio' => $this->faker->dateTime(),
            'fecha_fin' => $this->faker->dateTime(),
        ];
    }
}
