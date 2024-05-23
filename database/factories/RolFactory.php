<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Permiso;
// use App\Models\Permisos;
use App\Models\Rol;
// made by Lucas , modified by Harkaitz

class RolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rol::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            // 'permisos_id' => Permisos::factory(),
            'permiso_id' => Permiso::factory(),
        ];
    }
}
