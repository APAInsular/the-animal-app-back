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
            'nombre' => $this->faker->name,
            // 'edad' => $this->faker->numberBetween(1, 15),
            'historia' => $this->faker->paragraph,
            'especie' => Especie::factory(), // Relación con Especie
            'alimentacion' => Alimentacion::factory(), // Relación con Alimentacion
            'cuidados' => Cuidados::factory(), // Relación con Cuidados
            'necesidades' => Necesidades::factory(), // Relación con Necesidades
            'foto' => $this->faker->imageUrl(640, 480, 'animals', true, 'cats'),
            'fecha_esterilizacion' => $this->faker->optional()->date(),
            'fecha_nacimiento' => $this->faker->optional()->date(),
            'fecha_llegada' => $this->faker->optional()->date(),
            'fecha_fallecimiento' => $this->faker->optional()->date(),
            'raza' => $this->faker->word,
            'tipo' => $this->faker->word,
            // 'microchip' => $this->faker->optional()->unique()->regexify('[A-Za-z0-9]{15}'),
            'esterilizado' => $this->faker->boolean,
            'zoocan' => $this->faker->boolean,
            'cartilla' => $this->faker->boolean,
            'desparasitacion' => $this->faker->optional()->date(),
            'superpoder' => $this->faker->word,
            'descripcion' => $this->faker->paragraph,
        ];
    }
}
