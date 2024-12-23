<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idUser' => $this->faker->word(),
            'FirstName' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'LastName' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'Email' => $this->faker->regexify('[A-Za-z0-9]{45}'),
        ];
    }
}
