<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Animal;
use App\Models\Tareas;
use App\Models\Voluntario;

class TareasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tareas::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'descripcion' => $this->faker->text(),
            // 'SeRepite' => $this->faker->randomElement(['Si', 'No']), // Valor válido para el enum
            'fecha' => $this->faker->date(),
            'comentario' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            // 'finalizada' => $this->faker->randomElement(['Si', 'No']), // Valor válido para el enum
            'animal_id' => Animal::factory(),
            'voluntario_id' => Voluntario::factory(),
        ];
    }
}
