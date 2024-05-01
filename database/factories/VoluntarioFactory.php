<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Formacion;
use App\Models\User;
use App\Models\Voluntario;

class VoluntarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voluntario::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'apellido' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'email' => $this->faker->safeEmail(),
            'contraseña' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'disponibilidad' => $this->faker->date(),
            'idioma' => $this->faker->text(),
            'horario' => $this->faker->time(),
            'user_id' => User::factory(),
            'formacion_id' => Formacion::factory(),
        ];
    }
}
