<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Padrino;
use App\Models\User;
// made by Lucas

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
            'nombre' => $this->faker->word(),
            'apellido' => $this->faker->word(),
            'email' => $this->faker->word(),
            'telefono' => $this->faker->word(),
            'user_id' => User::factory(),
        ];
    }
}
