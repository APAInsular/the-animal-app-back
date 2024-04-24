<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Padrino;
use App\Models\User;

class PadrinoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Padrino::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'apellido' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'email' => $this->faker->safeEmail(),
            'telefono' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'user_id' => User::factory(),
        ];
    }
}
