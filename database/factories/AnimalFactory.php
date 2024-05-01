<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Alimentacion;
use App\Models\Animal;
use App\Models\Cuidados;
use App\Models\Especie;
use App\Models\Necesidades;
use App\Models\Tareas;

class AnimalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Animal::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'edad' => $this->faker->numberBetween(1, 20),
            'historia' => $this->faker->paragraph(),
            'especie_id' => \App\Models\Especie::factory(),
            'alimentacion_id' => \App\Models\Alimentacion::factory(),
            'cuidados_id' => \App\Models\Cuidados::factory(),
            'necesidades_id' => \App\Models\Necesidades::factory(),
            'tarea_id' => \App\Models\Tareas::factory(),
        ];
    }
}
