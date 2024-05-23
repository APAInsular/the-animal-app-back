<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Permiso;
// made by Lucas

class PermisoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permiso::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->text(),
        ];
    }
}
