<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Animal;
use App\Models\Task;
use App\Models\User;
use App\Models\Zone;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idTask' => $this->faker->word(),
            'Title' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'Description' => $this->faker->text(),
            'zone_id' => Zone::factory(),
            'animal_id' => Animal::factory(),
            'user_id' => User::factory(),
        ];
    }
}
