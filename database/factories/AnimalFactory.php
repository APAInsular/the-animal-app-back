<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Alimentacion;
use App\Models\Animal;
use App\Models\Cuidados;
use App\Models\Especie;
use App\Models\Necesidades;
use App\Models\Tarea;

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
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'edad' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'historia' => $this->faker->text(),
            'especie_id' => Especie::factory(),
            'alimentacion_id' => Alimentacion::factory(),
            'cuidados_id' => Cuidados::factory(),
            'necesidades_id' => Necesidades::factory(),
            'tarea_id' => Tarea::factory(),
        ];
    }
}
