<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DireccionUsuario;
use App\Models\User;
// made by Lucas

class DireccionUsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DireccionUsuario::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'calle' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'numero' => $this->faker->numberBetween(-10000, 10000),
            'ciudad' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'localidad' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'codigo_postal' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'user_id' => User::factory(),
        ];
    }
}
